<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function ping(): JsonResponse
    {
        return response()->json('Ping - Running ...');
    }
}
