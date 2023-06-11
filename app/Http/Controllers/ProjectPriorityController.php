<?php

namespace App\Http\Controllers;

use App\Data\ProjectPriority\ProjectPriorityCreateData;
use App\Data\ProjectPriority\ProjectPriorityInputData;
use App\Data\ProjectPriority\ProjectPriorityCalculateOutputData;
use App\Data\ProjectPriority\ProjectPriorityOutputData;
use App\Models\Manpower;
use App\Models\MaterialFeasibility;
use App\Models\MoneyEstimate;
use App\Models\Project;
use App\Models\ProjectPriority;
use App\Models\TimeSpan;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProjectPriorityController extends Controller
{
    use HttpResponses;

    const route = 'project-priority';

    public function timeSpan()
    {
        (array) $data = TimeSpan::all()->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }
    public function moneyEstimate()
    {
        (array) $data = MoneyEstimate::all()->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }
    public function manpower()
    {
        (array) $data = Manpower::all()->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }
    public function materialFeasibility()
    {
        (array) $data = MaterialFeasibility::all()->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }
    public function show(string $projectId)
    {
        /** @var ProjectPriority|null $projectPriority */
        $projectPriority = ProjectPriority::where('project_id', $projectId)->first();
        $data = ProjectPriorityOutputData::fromProjectPriority($projectPriority)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }
    public function store(ProjectPriorityCreateData $req)
    {
        (array) $data =  ProjectPriority::updateOrCreate([
            'project_id' => $req->project_id
        ], [
            'time_span_id' => $req->time_span_id,
            'money_estimate_id' => $req->money_estimate_id,
            'manpower_id' => $req->manpower_id,
            'material_feasibility_id' => $req->material_feasibility_id
        ])->toArray();
        return $this->success($data, "Project priority successfully created", Response::HTTP_CREATED);
    }

    /*
    rentang waktu = cost
    estimasi uang = cost
    orang yang terlibat = benefit
    kelayakan material operasional = benefit

    benefit = makin tinggi makin bagus
    cost = makin rendah makin bagus

    time_span
    money_estimate
    manpower
    material_feasibility
    */
    public function saw(ProjectPriorityInputData $req)
    {
        $w = [$req->time_span, $req->money_estimate, $req->manpower, $req->material_feasibility];

        $projects = DB::table('project_priorities')
            ->join('time_spans', 'project_priorities.time_span_id', '=', 'time_spans.id')
            ->join('money_estimates', 'project_priorities.money_estimate_id', '=', 'money_estimates.id')
            ->join('manpowers', 'project_priorities.manpower_id', '=', 'manpowers.id')
            ->join('material_feasibilities', 'project_priorities.material_feasibility_id', '=', 'material_feasibilities.id')
            ->select(
                'project_priorities.project_id as project_id',
                'time_spans.weight as time_spans_weight',
                'money_estimates.weight as money_estimates_weight',
                'manpowers.weight as manpowers_weight',
                'material_feasibilities.weight as material_feasibilities_weight'
            )->get();

        $minTimeSpanWeight = DB::table('project_priorities')
            ->join('time_spans', 'project_priorities.id', '=', 'time_spans.id')
            ->min('time_spans.weight');
        $minMoneyEstimate = DB::table('project_priorities')
            ->join('money_estimates', 'project_priorities.id', '=', 'money_estimates.id')
            ->min('money_estimates.weight');
        $maxManpower = DB::table('project_priorities')
            ->join('manpowers', 'project_priorities.id', '=', 'manpowers.id')
            ->max('manpowers.weight');
        $maxMaterialFeasibility = DB::table('project_priorities')
            ->join('material_feasibilities', 'project_priorities.id', '=', 'material_feasibilities.id')
            ->max('material_feasibilities.weight');

        /// Normalisasi (n)
        $r = collect();
        foreach ($projects as $i => $project) {
            $temp = new stdClass;
            $temp->project_id = $project->project_id;
            $temp->time_span = $minTimeSpanWeight / $project->time_spans_weight;
            $temp->money_estimate = $minMoneyEstimate / $project->money_estimates_weight;
            $temp->manpower = $project->manpowers_weight / $maxManpower;
            $temp->material_feasibility =  $project->material_feasibilities_weight / $maxMaterialFeasibility;

            $r->push($temp);
        }

        /// Nilai Preferensi (v)
        $v = collect();
        foreach ($r as $i => $r_norm) {
            $temp = new stdClass;
            $temp->project_id = $r_norm->project_id;
            $temp->time_span = $w[0] * $r_norm->time_span;
            $temp->money_estimate = $w[1] * $r_norm->money_estimate;
            $temp->manpower = $w[2] * $r_norm->manpower;
            $temp->material_feasibility = $w[3] * $r_norm->material_feasibility;
            $temp->v = $temp->time_span + $temp->money_estimate + $temp->manpower + $temp->material_feasibility;

            $v->push($temp);
        }

        // Sorting berdasarkan Nilai Preferensi
        $sort = $v->toArray();
        usort($sort, function ($a, $b) {
            if ($a->v == $b->v) return 0;
            return ($a->v > $b->v) ? -1 : 1;
        });

        (array) $data = ProjectPriorityCalculateOutputData::collection($sort)->include('project')->toArray();
        return $this->success($data, null);
    }

    public function sawProve(ProjectPriorityInputData $req)
    {
        // return $req;
        $w = [$req->time_span, $req->money_estimate, $req->manpower, $req->material_feasibility];

        $projects = DB::table('project_priorities')
            ->join('time_spans', 'project_priorities.time_span_id', '=', 'time_spans.id')
            ->join('money_estimates', 'project_priorities.money_estimate_id', '=', 'money_estimates.id')
            ->join('manpowers', 'project_priorities.manpower_id', '=', 'manpowers.id')
            ->join('material_feasibilities', 'project_priorities.material_feasibility_id', '=', 'material_feasibilities.id')
            ->select(
                'project_priorities.project_id as project_id',
                'time_spans.weight as time_spans_weight',
                'money_estimates.weight as money_estimates_weight',
                'manpowers.weight as manpowers_weight',
                'material_feasibilities.weight as material_feasibilities_weight'
            )->get();
        // dd($projects);
        // return $projects;
        // return $projects[0]['project_id'];   // Error
        // return $projects[0]->project_id;     // OK

        $minTimeSpanWeight = DB::table('project_priorities')
            ->join('time_spans', 'project_priorities.id', '=', 'time_spans.id')
            ->min('time_spans.weight');
        $minMoneyEstimate = DB::table('project_priorities')
            ->join('money_estimates', 'project_priorities.id', '=', 'money_estimates.id')
            ->min('money_estimates.weight');
        $maxManpower = DB::table('project_priorities')
            ->join('manpowers', 'project_priorities.id', '=', 'manpowers.id')
            ->max('manpowers.weight');
        $maxMaterialFeasibility = DB::table('project_priorities')
            ->join('material_feasibilities', 'project_priorities.id', '=', 'material_feasibilities.id')
            ->max('material_feasibilities.weight');
        // return [$minTimeSpanWeight, $minMoneyEstimate, $maxManpower, $maxMaterialFeasibility];

        /// Normalisasi (n)
        $r = collect();
        foreach ($projects as $i => $project) {
            $temp = new stdClass;
            $temp->project_id = $project->project_id;
            $temp->time_span = $minTimeSpanWeight / $project->time_spans_weight;
            $temp->money_estimate = $minMoneyEstimate / $project->money_estimates_weight;
            $temp->manpower = $project->manpowers_weight / $maxManpower;
            $temp->material_feasibility =  $project->material_feasibilities_weight / $maxMaterialFeasibility;

            $r->push($temp);
        }
        // dd($r);
        // dd($r[0]->project_id);
        // return $r;

        /// Nilai Preferensi (v)
        $v = collect();
        foreach ($r as $i => $r_norm) {
            $temp = new stdClass;
            $temp->project_id = $r_norm->project_id;
            $temp->time_span = $w[0] * $r_norm->time_span;
            $temp->money_estimate = $w[1] * $r_norm->money_estimate;
            $temp->manpower = $w[2] * $r_norm->manpower;
            $temp->material_feasibility = $w[3] * $r_norm->material_feasibility;
            $temp->v = $temp->time_span + $temp->money_estimate + $temp->manpower + $temp->material_feasibility;
            $v->push($temp);
        }

        // dd($v);

        // $sort = sort($v->v, SORT_NUMERIC);
        // dd($sort);

        $sort = $v->toArray();

        usort($sort, function ($a, $b) {
            if ($a->v == $b->v) return 0;
            return ($a->v > $b->v) ? -1 : 1;
        });
        // dd($sort);

        (array) $data = ProjectPriorityCalculateOutputData::collection($sort)->include('project')->toArray();
        return $this->success($data, null);
    }
}
