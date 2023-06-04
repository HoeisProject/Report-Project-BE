<?php

namespace App\Http\Controllers;

use App\Data\Report\ReportCreateData;
use App\Data\Report\ReportOutputData;
use App\Data\Report\ReportUpdateData;
use App\Data\ReportMedia\ReportMediaOutputData;
use App\Models\Report;
use App\Models\ReportMedia;
use App\Models\ReportStatus;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReportController extends Controller
{
    use HttpResponses;

    const route = 'report';

    /// Ascending by updated_at
    public function index(Request $request)
    {
        (string) $project = $request->query('project') ? 'project' : '';
        (string) $user = $request->query('user') ? 'user' : '';
        (string) $reportStatus = $request->query('reportStatus') ? 'reportStatus' : '';

        $data = ReportOutputData::collection(Report::orderBy('updated_at')->paginate())->include($project, $user, $reportStatus)->toArray();

        return $this->successPaginate($data, null, Response::HTTP_OK);
    }

    /// Read Report By User
    public function user(Request $request, string $userId)
    {
        (string) $project = $request->query('project') ? 'project' : '';
        (string) $user = $request->query('user') ? 'user' : '';
        (string) $reportStatus = $request->query('reportStatus') ? 'reportStatus' : '';
        $reports = Report::where('user_id', $userId)->get();
        $data = ReportOutputData::collection($reports)->include($project, $user, $reportStatus)->toArray();

        return $this->success($data, null, Response::HTTP_OK);
    }

    /// Read Report Media By Report
    public function reportMedia(string $id)
    {
        $reportMedia = ReportMedia::where('report_id', $id)->get();
        $data = ReportMediaOutputData::collection($reportMedia)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    public function store(ReportCreateData $req)
    {
        // Id for pending status
        $reportStatusId = ReportStatus::where('name', 'pending')->first()->id;
        $report = new Report();
        $report->project_id = $req->project_id;
        $report->user_id = $req->user_id;   // Report can create on behalf other user, this is why do not use token
        $report->report_statuses_id = $reportStatusId;
        $report->title = $req->title;
        $report->description = $req->description;
        $report->position = $req->position;

        (bool) $isSuccess = $report->save();
        if (!$isSuccess) {
            return $this->error(null, 'Report failed created', Response::HTTP_BAD_REQUEST);
        }
        (array) $data = ReportOutputData::from($report)->toArray();
        return $this->success($data, 'Report successfully created', Response::HTTP_CREATED);
    }

    public function show(Report $report)
    {
        (array) $data = ReportOutputData::from($report)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    public function update(ReportUpdateData $req, Report $report)
    {
        (bool) $isSuccess = $report->update($req->all());
        (array) $data = ReportOutputData::from($report)->toArray();
        if ($isSuccess)
            return $this->success($data, 'Report successfully updated', Response::HTTP_OK);

        return $this->error($data, 'Report failed updated', Response::HTTP_BAD_REQUEST);
    }

    public function destroy(Report $report)
    {
        // Using Soft Delete
        $isSuccess = $report->delete();
        if ($isSuccess) {
            // (array) $data = ReportOutputData::from($report)->toArray();
            // return $this->success($data, 'Report successfully deleted', Response::HTTP_OK);
            return $this->success([], 'Report successfully deleted', Response::HTTP_OK);
            // return $this->success([], null, Response::HTTP_NO_CONTENT);
        }

        return $this->error(null, 'Project failed deleted', Response::HTTP_BAD_REQUEST);
    }

    public function restore(string $id)
    {
        $report = Report::withTrashed()->where('id', $id)->first();
        if ($report == null)
            throw new NotFoundHttpException();

        $isSuccess = $report->restore();

        if ($isSuccess) {
            (array) $data = ReportOutputData::from($report)->toArray();
            return $this->success($data, 'Project successfully restored', Response::HTTP_OK);
        }

        return $this->error(null, 'Project failed restored', Response::HTTP_BAD_REQUEST);
    }
    public function updateStatus(Report $report, Request $request)
    {
        $request->validate([
            'status' => ['required']
        ]);
        if (!ReportStatus::where('id', $request->status)->exists())
            return $this->error(null, 'Report status not found', Response::HTTP_BAD_REQUEST);

        $report->report_statuses_id = $request->status;
        $report->save();
        return $report->reportStatus;
    }
}
