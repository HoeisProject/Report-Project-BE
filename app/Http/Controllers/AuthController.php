<?php

namespace App\Http\Controllers;

use App\Data\User\UserLoginData;
use App\Data\User\UserRegisterData;
use App\Data\User\UserOutputData;
use App\Models\Role;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    use HttpResponses;

    public function currentUser(Request $request)
    {
        $user = $request->user();

        $data = UserOutputData::from($user)->include('role')->toArray();

        return $this->success($data, null, Response::HTTP_OK);
    }

    public function logout(Request $req)
    {
        // https://laravel.com/docs/10.x/sanctum#revoking-tokens
        // $req->user() only available if using middleware, for example auth:sanctum
        $req->user()->currentAccessToken()->delete();
        // $req->user()->tokens()->delete();

        return $this->success([], 'You have successfully been logged out and your token has been deleted', Response::HTTP_OK);
    }

    public function login(UserLoginData $req)
    {

        if (!Auth::attempt($req->only('email', 'password')->toArray())) {
            return $this->error(null, 'Credentials do not match', Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $req->email)->first();

        $token = $user->createToken('API Token of ' . $req->email);

        $data = UserOutputData::from($user)->toArray();

        return $this->successAuth($data, $token, null, Response::HTTP_OK);
    }

    public function register(UserRegisterData $req)
    {
        (string) $fileName = 'user-' . $req->email . '.' . $req->user_image->getClientOriginalExtension();
        (string) $fileImagePath =  $req->user_image->storeAs('public/users', $fileName);
        $roleIdEmployee = Role::where('name', 'employee')->first()->id;

        $user = new User();
        $user->role_id = $roleIdEmployee;
        $user->username = $req->username;
        $user->nickname = $req->nickname;
        $user->email = $req->email;
        $user->phone_number = $req->phone_number;
        $user->status = $req->status;
        $user->password = Hash::make($req->password);
        $user->user_image = $fileImagePath;

        (bool) $isSuccess = $user->save();

        if (!$isSuccess) {
            Storage::delete($fileImagePath);
            return $this->error(null, 'Register failed', Response::HTTP_BAD_REQUEST);
        }

        $data = UserOutputData::from($user)->toArray();

        // https://laravel.com/docs/10.x/sanctum#issuing-api-tokens
        $token = $user->createToken('API Token of ' . $user->email);

        return $this->successAuth($data, $token, null, Response::HTTP_CREATED);

        return [
            'user' => $user,
            'fileImagePath' => $fileImagePath,
            'url' => Storage::url($fileImagePath), // Tinggal di concat dengan BASE_URL
            'get' => Storage::get('storage/' . $fileImagePath),
            'asset' => asset($fileImagePath)
        ];
    }
}

/*
    "fileImagePath": "public/users/NBmxTJcXbRsZsZdgDcl3zwdYyLgeJqWMOnGnrp9Z.jpg",
    "url": "/storage/users/NBmxTJcXbRsZsZdgDcl3zwdYyLgeJqWMOnGnrp9Z.jpg",
    "asset": "http://127.0.0.1:8000/public/users/NBmxTJcXbRsZsZdgDcl3zwdYyLgeJqWMOnGnrp9Z.jpg"

    "fileImagePath": "public/users/rLelmnFL6dNPjEFE43FMwZfCUsK5C8oXc6hYvCci.jpg",
    "url": "/storage/users/rLelmnFL6dNPjEFE43FMwZfCUsK5C8oXc6hYvCci.jpg",
    "get": null,
    "asset": "http://127.0.0.1:8000/public/users/rLelmnFL6dNPjEFE43FMwZfCUsK5C8oXc6hYvCci.jpg"
*/

// λ php artisan storage:link

//    INFO  The [C:\laragon\www\Laravel\report-project-be\public\storage]
//      link has been connected to [C:\laragon\www\Laravel\report-project-be\storage\app/public].
