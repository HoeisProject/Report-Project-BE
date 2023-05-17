<?php

namespace App\Http\Controllers;

use App\Data\Role\RoleData;
use App\Models\Role;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    use HttpResponses;

    const route = 'role';

    public function index(): JsonResponse
    {
        (array) $data = RoleData::collection(Role::all())->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    public function store(RoleData $req): JsonResponse
    {
        (array) $data = Role::create($req->all())->toArray();
        return $this->success($data, 'Role successfully created', Response::HTTP_CREATED);
    }

    public function show(Role $role): JsonResponse
    {
        (array) $data = RoleData::from($role)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    public function update(RoleData $req, Role $role): JsonResponse
    {
        (bool) $isSuccess = $role->update($req->all());
        (array) $data = RoleData::from($role)->toArray();
        if ($isSuccess)
            return $this->success($data, 'Role successfully updated', Response::HTTP_OK);

        return $this->error($data, 'Role failed updated', Response::HTTP_BAD_REQUEST);
    }

    public function destroy(Role $role): JsonResponse
    {
        // (bool) $isSuccess = $role->delete();

        // if ($isSuccess) {
        //     (array) $data = RoleData::from($role)->toArray();
        //     return $this->success($data, 'Role successfully deleted', Response::HTTP_OK);
        // } else
        //     return $this->error(null, 'Role failed updated', Response::HTTP_BAD_REQUEST);

        return $this->error(null, 'Role cannot be deleted', Response::HTTP_BAD_REQUEST);
    }
}
