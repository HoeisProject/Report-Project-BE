<?php

namespace App\Http\Controllers;

use App\Models\ReportStatus;

use App\Data\ReportStatusData;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportStatusController extends Controller
{
    use HttpResponses;

    const route = 'report-status';

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        (array) $data['data'] = ReportStatusData::collection(ReportStatus::all())->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportStatusData $request): JsonResponse
    {
        (array) $data = ReportStatus::create($request->all())->toArray();
        return $this->success($data, 'Report status successfully created', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportStatus $reportStatus): JsonResponse
    {
        (array) $data = ReportStatusData::from($reportStatus)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportStatusData $request, ReportStatus $reportStatus)
    {
        // return $this->error($request->all(), null, 404);
        (bool) $isSuccess = $reportStatus->update($request->all());
        (array) $data = ReportStatusData::from($reportStatus)->toArray();
        // return $data;
        if ($isSuccess)
            return $this->success($data, 'Report status successfully updated', Response::HTTP_OK);

        return $this->error($data, 'Report status failed updated', Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
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
