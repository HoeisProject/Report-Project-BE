<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponses
{
    protected function success(array $data, ?string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'Request was successfull',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error(?array $data, ?string $message = null, int $code): JsonResponse
    {
        return response()->json([
            'status' => 'Error has occured',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function notFound(?string $message = null, int $code = 404): JsonResponse
    {
        return response()->json([
            'status' => 'NotFoundHttpException ',
            'message' => $message,
        ], $code);
    }
}
