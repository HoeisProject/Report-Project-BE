<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
