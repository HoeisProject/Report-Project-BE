<?php

namespace App\Http\Controllers;

use App\Data\RoleData;
use App\Models\Role;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    use HttpResponses;

    const route = 'role';

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        (array) $data = RoleData::collection(Role::all())->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleData $request): JsonResponse
    {
        (array) $data = Role::create($request->all())->toArray();
        return $this->success($data, 'Role successfully created', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): JsonResponse
    {
        (array) $data = RoleData::from($role)->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleData $request, Role $role): JsonResponse
    {
        (bool) $isSuccess = $role->update($request->all());
        (array) $data = RoleData::from($role)->toArray();
        if ($isSuccess)
            return $this->success($data, 'Role successfully updated', Response::HTTP_OK);

        return $this->error($data, 'Role failed updated', Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
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
