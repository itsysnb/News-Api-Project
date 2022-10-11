<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser
{
    public function successResponse($data, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data, 'code' => $code], $code, [], JSON_UNESCAPED_UNICODE);
    }

    public function errorResponse($data, int $code): JsonResponse
    {
        return response()->json(['error' => $data, 'code' => $code], $code, [], JSON_UNESCAPED_UNICODE);
    }
}
