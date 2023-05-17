<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotAnAdminException extends Exception
{
    public function render(Request $request)
    {
        // return $request->user();
        return response()->json([
            'message' => 'You are not an admin'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
