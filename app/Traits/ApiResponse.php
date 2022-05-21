<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * @OA\Schema(
     *     schema="ApiError",
     *      @OA\Property(
     *          property="message",
     *          type="string",
     *          example="Not Found",
     *      ),
     *      @OA\Property(
     *          property="status",
     *          type="string",
     *          example="error",
     *      )
     * )
     */
    protected function apiError(string $message, int $code = 500): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status'  => 'error'
        ], $code);
    }


    /**
     * @OA\Schema(
     *     schema="ApiSuccess",
     *      @OA\Property(
     *          property="data",
     *          type="array",
     *          @OA\Items(),
     *      ),
     *      @OA\Property(
     *          property="status",
     *          type="string",
     *          example="success"
     *      )
     * )
     */
    protected function apiSuccess(array $data, int $code = 200): JsonResponse
    {
        return response()->json([
            'data'   => $data,
            'status' => 'success'
        ], $code);
    }
}
