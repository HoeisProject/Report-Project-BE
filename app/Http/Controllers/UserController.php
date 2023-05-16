<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Data\UserData;
use App\Data\UserOutputData;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use HttpResponses;

    const route = 'user';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return User::find(1)->projects->toArray();
        // TODO Authentication Admin Only
        (array) $data = UserOutputData::collection(User::paginate())->toArray();
        // (array) $data = UserData::collection(User::all())->include('projects')->toArray();
        return $this->successPaginate($data, null, Response::HTTP_OK);
    }

    // Register Method in AuthController
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(User $id)
    {
        // (array) $data = User
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
