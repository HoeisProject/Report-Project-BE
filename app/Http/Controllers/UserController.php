<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Data\UserData;
use App\Data\UserOutputData;
use App\Data\UserVerifyData;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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
    public function show(User $user)
    {
        $data = UserOutputData::from($user)->toArray();

        return $this->success($data, null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }

    public function verify(UserVerifyData $req, Request $request)
    {
        (string) $fileName = 'ktp-' . $request->user()->email . '.' . $req->ktp_image->getClientOriginalExtension();
        (string) $fileImagePath =  $req->ktp_image->storeAs('public/ktp', $fileName);
        $user = $request->user();
        $user->nik = $req->nik;
        $user->status = 2;  // Pending
        $user->ktp_image  = $fileImagePath;

        (bool) $isSuccess = $user->save();

        if (!$isSuccess) {

            Storage::delete($fileImagePath);
            return $this->error(null, 'Register failed', Response::HTTP_BAD_REQUEST);
        }
        (array) $data = UserOutputData::from($user)->toArray();

        return $this->success($data, 'User successfully verified', Response::HTTP_OK);
    }
}
