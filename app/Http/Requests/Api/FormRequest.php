<?php

namespace App\Http\Requests\Api;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

abstract class FormRequest extends LaravelFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json([
                'message' => $errors,
                'status' => 'fail',
            ], FoundationResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
