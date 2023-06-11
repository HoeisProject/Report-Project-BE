<?php

namespace App\Http\Controllers;

use App\Models\ReportStatus;

use App\Data\ReportStatus\ReportStatusData;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ReportStatusController extends Controller
{
    use HttpResponses;

    const route = 'report-status';

    public function index(): JsonResponse
    {
        (array) $data = ReportStatusData::collection(ReportStatus::paginate())->toArray();
        return $this->successPaginate($data, null, Response::HTTP_OK);
    }

    public function store(ReportStatusData $req): JsonResponse
    {
        (array) $data = ReportStatus::create($req->all())->toArray();
        return $this->success($data, 'Report status successfully created', Response::HTTP_CREATED);
    }

    public function show(ReportStatus $reportStatus): JsonResponse
    {
        (array) $data = ReportStatusData::from($reportStatus)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    public function update(ReportStatusData $req, ReportStatus $reportStatus)
    {
        // return $this->error($req->all(), null, 404);
        (bool) $isSuccess = $reportStatus->update($req->all());
        (array) $data = ReportStatusData::from($reportStatus)->toArray();
        // return $data;
        if ($isSuccess)
            return $this->success($data, 'Report status successfully updated', Response::HTTP_OK);

        return $this->error($data, 'Report status failed updated', Response::HTTP_BAD_REQUEST);
    }

    public function destroy(ReportStatus $reportStatus): JsonResponse
    {
        // (bool) $isSuccess = $reportStatus->delete();

        // if ($isSuccess) {
        //     (array) $data = ReportStatusData::from($reportStatus)->toArray();
        //     return $this->success($data, 'Report status successfully deleted', Response::HTTP_OK);
        // } else
        //     return $this->error(null, 'Report status failed updated', Response::HTTP_BAD_REQUEST);

        return $this->error(null, 'Report status cannot be deleted', Response::HTTP_BAD_REQUEST);
    }
}
