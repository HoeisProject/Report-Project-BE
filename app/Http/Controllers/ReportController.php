<?php

namespace App\Http\Controllers;

use App\Data\Report\ReportCreateData;
use App\Data\Report\ReportOutputData;
use App\Data\Report\ReportUpdateData;
use App\Models\Report;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReportController extends Controller
{
    use HttpResponses;

    const route = 'report';

    public function index()
    {
        $data = ReportOutputData::collection(Report::paginate())->toArray();

        return $this->successPaginate($data, 'success', Response::HTTP_OK);
    }

    public function store(ReportCreateData $req)
    {
        (array) $data = Report::create($req->all())->toArray();
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
}
