<?php

namespace App\Http\Requests\Api;

/**
 * @OA\Schema()
 */
class EventSearchRequest extends FormRequest
{
    /**
     * @OA\Property(format="string", default="Lisbon", description="City/country", property="term"),
     * @OA\Property(format="string", default="2022-06-21", description="Date", property="date"),
     */
    public function rules()
    {
        return [
            'term' => 'required|string|max:255',
            'date' => 'required|date:Y-m-d'//|after:now',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
