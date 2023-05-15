<?php

namespace App\Http\Controllers;

use App\Data\ProjectData;
use App\Data\ProjectInputData;
use App\Data\ProjectOutputData;
use App\Models\Project;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    use HttpResponses;

    const route = 'project';

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // return Project::withTrashed()->get();
        // (array) $data = ProjectOutputData::collection(Project::withTrashed()->paginate())->include('user.role')->toArray();  // With Role
        (array) $data = ProjectOutputData::collection(Project::withTrashed()->paginate())->include('user')->toArray();
        return $this->successPaginate($data, null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectInputData $request): JsonResponse
    {
        // TODO Only Role Admin
        (array) $data = Project::create($request->all())->toArray();
        return $this->success($data, 'Project successfully created', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): JsonResponse
    {
        (array) $data = ProjectOutputData::from($project)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectInputData $request, Project $project): JsonResponse
    {
        // TODO Only Role Admin
        // TODO user_id, start_date, end_date => can not update
        (bool) $isSuccess = $project->update($request->all());
        (array) $data = ProjectOutputData::from($project)->toArray();
        if ($isSuccess)
            return $this->success($data, 'Project successfully updated', Response::HTTP_OK);

        return $this->error($data, 'Project failed updated', Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        // Using Soft Delete
        $isSuccess = $project->delete();
        if ($isSuccess) {
            // (array) $data = ProjectData::from($project)->toArray();
            // return $this->success($data, 'Project successfully deleted', Response::HTTP_OK);
            return $this->success([], 'Project successfully deleted', Response::HTTP_OK);
            // return $this->success([], null, Response::HTTP_NO_CONTENT);
        }

        return $this->error(null, 'Project failed deleted', Response::HTTP_BAD_REQUEST);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $project = Project::withTrashed()->where('id', $id)->first();
        $isSuccess = $project->restore();
        if ($isSuccess) {
            (array) $data = ProjectOutputData::from($project)->toArray();
            return $this->success($data, 'Project successfully restored', Response::HTTP_OK);
        }

        return $this->error(null, 'Project failed restored', Response::HTTP_BAD_REQUEST);
    }
}
