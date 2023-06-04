<?php

namespace App\Http\Controllers;

use App\Data\ProjectData;
use App\Data\Project\ProjectCreateData;
use App\Data\Project\ProjectOutputData;
use App\Data\Project\ProjectUpdateData;
use App\Data\Report\ReportOutputData;
use App\Models\Project;
use App\Models\Report;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\Builder;

class ProjectController extends Controller
{
    use HttpResponses;

    const route = 'project';

    public function index(): JsonResponse
    {
        // return Project::withTrashed()->get();
        // (array) $data = ProjectOutputData::collection(Project::withTrashed()->paginate())->include('user.role')->toArray();  // With Role
        (array) $data = ProjectOutputData::collection(Project::withTrashed()->paginate())->include('user')->toArray();
        return $this->successPaginate($data, null, Response::HTTP_OK);
    }

    /// Get report by project
    public function report(Request $request, string $id)
    {
        (string) $projectParam = $request->query('project') ? 'project' : '';
        (string) $userParam = $request->query('user') ? 'user' : '';
        (string) $reportStatusParam = $request->query('reportStatus') ? 'reportStatus' : '';
        (bool) $isRejected = $request->query('showOnlyRejected') ? true : false;  // Included with report status rejected

        $user = $request->user();

        if ($user->role->name == 'admin')
            $rawReports = Report::where('project_id', $id)->get();
        else
            $rawReports = Report::where('project_id', $id)->where('user_id', $user->id)->get();

        $reports = [];
        if ($isRejected)
            for ($i = 0; $i < count($rawReports); $i++) {
                if ($rawReports[$i]->reportStatus->name == 'reject')
                    array_push($reports, $rawReports[$i]);
            }
        else
            for ($i = 0; $i < count($rawReports); $i++) {
                if ($rawReports[$i]->reportStatus->name != 'reject')
                    array_push($reports, $rawReports[$i]);
            }

        $data = ReportOutputData::collection($reports)->include($projectParam, $userParam, $reportStatusParam)->toArray();

        // return $this->successPaginate($data, null, Response::HTTP_OK);
        return $this->success($data, null, Response::HTTP_OK);
    }

    public function store(ProjectCreateData $req, Request $request): JsonResponse
    {
        (array) $data = Project::create($req->all())->toArray();
        return $this->success($data, 'Project successfully created', Response::HTTP_CREATED);
    }

    public function show(Project $project): JsonResponse
    {
        (array) $data = ProjectOutputData::from($project)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    public function update(ProjectUpdateData $req, Project $project): JsonResponse
    {
        (bool) $isSuccess = $project->update($req->all());
        (array) $data = ProjectOutputData::from($project)->toArray();
        if ($isSuccess)
            return $this->success($data, 'Project successfully updated', Response::HTTP_OK);

        return $this->error($data, 'Project failed updated', Response::HTTP_BAD_REQUEST);
    }

    public function destroy(Project $project): JsonResponse
    {
        // Using Soft Delete
        (bool)  $isSuccess = $project->delete();
        if ($isSuccess) {
            // (array) $data = ProjectData::from($project)->toArray();
            // return $this->success($data, 'Project successfully deleted', Response::HTTP_OK);
            return $this->success([], 'Project successfully deleted', Response::HTTP_OK);
            // return $this->success([], null, Response::HTTP_NO_CONTENT);
        }

        return $this->error(null, 'Project failed deleted', Response::HTTP_BAD_REQUEST);
    }

    public function restore(string $id)
    {
        $project = Project::withTrashed()->where('id', $id)->first();
        if ($project == null)
            throw new NotFoundHttpException();

        (bool) $isSuccess = $project->restore();
        if ($isSuccess) {
            (array) $data = ProjectOutputData::from($project)->toArray();
            return $this->success($data, 'Project successfully restored', Response::HTTP_OK);
        }

        return $this->error(null, 'Project failed restored', Response::HTTP_BAD_REQUEST);
    }
}
