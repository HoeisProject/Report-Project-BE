<?php

namespace App\Http\Controllers;

use App\Data\UserLoginData;
use App\Data\UserRegisterData;
use App\Data\UserOutputData;
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

    public function logout(Request $request)
    {
        // https://laravel.com/docs/10.x/sanctum#revoking-tokens
        // $request->user() only available if using middleware, for example auth:sanctum
        $request->user()->currentAccessToken()->delete();
        // $request->user()->tokens()->delete();

        return $this->success([], 'You have successfully been logged out and your token has been deleted', Response::HTTP_OK);
    }

    public function login(UserLoginData $request)
    {

        if (!Auth::attempt($request->only('email', 'password')->toArray())) {
            return $this->error(null, 'Credentials do not match', Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('API Token of ' . $request->email);

        $data = UserOutputData::from($user)->toArray();

        return $this->successAuth($data, $token, null, Response::HTTP_OK);
    }

    public function register(UserRegisterData $request)
    {
        $fileImagePath =  $request->user_image->storeAs('public/users', $request->user_image->hashName());

        $user = new User();
        $user->role_id = $request->role_id;
        $user->username = $request->username;
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
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
