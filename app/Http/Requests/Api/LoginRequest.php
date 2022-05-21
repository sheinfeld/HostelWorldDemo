<?php

namespace App\Http\Requests\Api;

/**
 * @OA\Schema()
 */
class LoginRequest extends FormRequest
{
    /**
     * @OA\Property(format="string", default="example@app.com", description="email", property="email"),
     * @OA\Property(format="string", default="password", description="password", property="password"),
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
