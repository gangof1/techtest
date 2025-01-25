<?php

namespace App;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ErrorHandlingTrait
{
    protected function handleError(string $message, int $statusCode = 400): JsonResponse
    {
        Log::error($message);
        return response()->json([
            'success' => false,
            'error' => 'operation_failed',
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }

    protected function handleSuccess(string $message, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }
}
