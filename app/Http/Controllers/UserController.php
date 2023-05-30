<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Data\User\UserOutputData;
use App\Data\User\UserUpdatePropertiesData;
use App\Data\User\UserVerifyData;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Enum\UserStatusEnum;
use DateTime;

class UserController extends Controller
{
    use HttpResponses;

    const route = 'user';

    // Index, UpdateStatus using NotAnAdminMiddleware
    // Register in AuthController@Register
    // Destroy in AdminController

    // NotAnAdminMiddleware
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

    public function updateProperties(UserUpdatePropertiesData $req, Request $request)
    {
        $data = array();
        $user = $request->user();
        if ($req->username != null) {
            $user->username = $req->username;
            $data['username'] = $req->username;
        }
        // if ($req->email != null)
        //     $user->email = $req->email;

        if ($req->phone_number != null) {
            $user->phone_number = $req->phone_number;
            $data['phone_number'] = $req->phone_number;
        }
        if ($req->nik != null) {
            $user->nik = $req->nik;
            $data['nik'] = $req->nik;
        }

        if ($req->user_image != null) {
            Storage::delete($user->user_image);
            (string) $date = date('YmdHis');
            (string) $fileName = 'user-' . $request->user()->email . '-' . $date . '.' . $req->user_image->getClientOriginalExtension();
            (string) $fileImagePath =  $req->user_image->storeAs('public/user', $fileName);
            $user->user_image = $fileImagePath;
            $data['user_image'] = $fileImagePath;
        }

        if ($req->ktp_image != null) {
            Storage::delete($user->ktp_image);
            (string)  $date = date('YmdHis');
            (string) $fileName = 'ktp-' . $request->user()->email . '-' . $date . '.' . $req->ktp_image->getClientOriginalExtension();
            (string) $fileImagePath =  $req->ktp_image->storeAs('public/ktp', $fileName);
            $user->ktp_image = $fileImagePath;
            $data['ktp_image'] = $fileImagePath;
        }
        // return $req->all();

        (bool) $isSuccess = $user->save();



        if ($isSuccess)
            return $this->success($data, 'Update properties success', Response::HTTP_OK);

        if ($req->ktp_image != null) {
            Storage::delete($user->ktp_image);
        }
        return $this->error(null, 'Update properties failed', Response::HTTP_BAD_REQUEST);
    }

    // NotAnAdminMiddleware
    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);
        $user->status = $request->status;
        (bool) $isSuccess = $user->save();
        (array) $data = UserOutputData::from($user)->toArray();
        if ($isSuccess)
            return $this->success($data, 'User status successfully updated', Response::HTTP_OK);

        return $this->error($data, 'User status failed updated', Response::HTTP_BAD_REQUEST);
    }

    public function verify(UserVerifyData $req, Request $request)
    {
        (string) $fileName = 'ktp-' . $request->user()->email . '.' . $req->ktp_image->getClientOriginalExtension();
        (string) $fileImagePath =  $req->ktp_image->storeAs('public/ktp', $fileName);
        $user = $request->user();
        $user->nik = $req->nik;
        $user->status = UserStatusEnum::PENDING->value;  // Pending
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
