<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\LoginRequest;
use App\Traits\ApiResponse;
use Throwable;

class AuthController extends ApiController
{
    use ApiResponse;

    /**
     * @OA\Post  (
     *     tags={"UnAuthorize"},
     *     path="/auth/login",
     *     summary="User login",
     *     @OA\RequestBody(
     *          required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 ref="#/components/schemas/LoginRequest",
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Success", @OA\JsonContent(type="object", @OA\Property(format="string", default="1|475IzWp7mWNfF2JR12owRsMP1Q0T6grGX3lgBdzr", description="access_token", property="access_token"))),
     *     @OA\Response(response="401", description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/ApiRequestException")),
     *     @OA\Response(response="422", description="Unprocessable Entity", @OA\JsonContent(ref="#/components/schemas/ApiValidationException")),
     *     @OA\Response(response="500", description="Internal Server Error", @OA\JsonContent(ref="#/components/schemas/ApiSystemException"))
     * )
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            if (!auth()->attempt($request->only(['email', 'password'])))
                return $this->apiError("Unauthorized", 401);

            return $this->apiSuccess([
                'access_token' => auth()->user()->createToken('authToken')->plainTextToken,
            ]);

        } catch (Throwable $e) {
            return $this->apiError($e->getMessage());
        }
    }
}
