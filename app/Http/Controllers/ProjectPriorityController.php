<?php

namespace App\Http\Controllers;

use App\Data\ProjectPriority\ProjectPriorityInputData;
use App\Data\ProjectPriority\ProjectPriorityOutputData;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProjectPriorityController extends Controller
{
    use HttpResponses;

    const route = 'project-priority';

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
        // return $req;
        $w = [$req->time_span, $req->money_estimate, $req->manpower, $req->material_feasibility];

        $projects = DB::table('project_priorities')
            ->join('time_spans', 'project_priorities.time_spans_id', '=', 'time_spans.id')
            ->join('money_estimates', 'project_priorities.money_estimates_id', '=', 'money_estimates.id')
            ->join('manpowers', 'project_priorities.manpowers_id', '=', 'manpowers.id')
            ->join('material_feasibilities', 'project_priorities.material_feasibilities_id', '=', 'material_feasibilities.id')
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
            $temp->time_spans = $minTimeSpanWeight / $project->time_spans_weight;
            $temp->money_estimates = $minMoneyEstimate / $project->money_estimates_weight;
            $temp->manpowers = $maxManpower / $project->manpowers_weight;
            $temp->material_feasibilities = $maxMaterialFeasibility / $project->material_feasibilities_weight;

            $r->push($temp);
        }
        // dd($r);
        // dd($r[0]->project_id);

        /// Nilai Preferensi (v)
        $v = collect();
        foreach ($r as $i => $r_norm) {
            $temp = new stdClass;
            $temp->project_id = $r_norm->project_id;
            $temp->time_spans = $w[0] * $r_norm->time_spans;
            $temp->money_estimates = $w[1] * $r_norm->money_estimates;
            $temp->manpowers = $w[2] * $r_norm->manpowers;
            $temp->material_feasibilities = $w[3] * $r_norm->material_feasibilities;
            $temp->v = $temp->time_spans + $temp->money_estimates + $temp->manpowers + $temp->material_feasibilities;
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

        (array) $data = ProjectPriorityOutputData::collection($sort)->include('project')->toArray();
        return $this->success($data, null);
    }
}
