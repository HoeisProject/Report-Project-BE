<?php

namespace App\Http\Controllers;

use App\Enum\UserStatusEnum;
use Illuminate\Http\JsonResponse;

class DevToolController extends Controller
{
    public function ping(): JsonResponse
    {
        return response()->json('Ping - Running ...');
    }
    public function pingAuthorize(): JsonResponse
    {
        return response()->json('Ping Authorize - Running ...');
    }
    public function UserStatusEnum()
    {
        return UserStatusEnum::PENDING->value;
    }
}
