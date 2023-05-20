<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Data\User\UserOutputData;
use App\Data\User\UserVerifyData;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use HttpResponses;

    const route = 'user';

    // Index using NotAnAdminMiddleware
    // Register in AuthController@Register
    // Destroy in AdminController

    public function index()
    {
        (array) $data = UserOutputData::collection(User::paginate())->toArray();
        // (array) $data = UserData::collection(User::all())->include('projects')->toArray();
        return $this->successPaginate($data, null, Response::HTTP_OK);
    }

    public function show(User $user)
    {
        $data = UserOutputData::from($user)->toArray();

        return $this->success($data, null, Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        //
    }

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
