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
            'term' => 'nullable|string|max:255',
            'date' => 'nullable|date:Y-m-d|after_or_equal:today',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
