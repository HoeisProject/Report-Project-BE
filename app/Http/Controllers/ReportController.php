<?php

namespace App\Http\Controllers;

use App\Data\ReportInputData;
use App\Data\ReportOutputData;
use App\Models\Report;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    use HttpResponses;

    const route = 'report';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ReportOutputData::collection(Report::paginate())->toArray();

        // Illuminate\\Pagination\\LengthAwarePaginator
        return $this->successPaginate($data, 'success', Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportInputData $request)
    {
        // TODO Only authorized employee
        (array) $data = Report::create($request->all())->toArray();
        return $this->success($data, 'Report successfully created', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        (array) $data = ReportOutputData::from($report)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReportInputData $request, Report $report)
    {
        (bool) $isSuccess = $report->update($request->all());
        (array) $data = ReportOutputData::from($report)->toArray();
        if ($isSuccess)
            return $this->success($data, 'Report successfully updated', Response::HTTP_OK);

        return $this->error($data, 'Report failed updated', Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
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
        $isSuccess = $report->restore();

        if ($isSuccess) {
            (array) $data = ReportOutputData::from($report)->toArray();
            return $this->success($data, 'Project successfully restored', Response::HTTP_OK);
        }

        return $this->error(null, 'Project failed restored', Response::HTTP_BAD_REQUEST);
    }
}
