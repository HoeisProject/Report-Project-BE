<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Data\UserData;
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
        (array) $data = UserData::collection(User::all())->toArray();
        return $this->success($data, null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
