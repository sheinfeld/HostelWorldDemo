<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class EventResource
 * @package App\Http\Controllers\Resources
 * @OA\Schema(
 * )
 */
class EventResource extends JsonResource
{
    /**
     * @OA\Property(
     *     type="object",
     *     property="events",
         * @OA\Property(
         *     property="id",
         *     title="ID",
         *     description="ID",
         *     format="int64",
         *     example=1
         * ),
         * @OA\Property(
         *      property="name",
         *      title="Name",
         *      description="Name of the new Event",
         *      example="Rock in Rio 2022"
         * ),
         * @OA\Property(
         *      property="city",
         *      title="City",
         *      description="City where the event is taking place",
         *      example="Lisbon"
         * ),
         * @OA\Property(
         *      property="country",
         *      title="Country",
         *      description="Country where the event is taking place",
         *      example="Portugal"
         * ),
         * @OA\Property(
         *     property="startDate",
         *     title="Start Date",
         *     description="Start Date",
         *     example="2020-01-27",
         *     format="date",
         *     type="string"
         * ),
         * @OA\Property(
         *     property="endDate",
         *     title="End Date",
         *     description="End Date",
         *     example="2020-01-27",
         *     format="date",
         *     type="string"
         * ),
     * )
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return parent::toArray($request);
    }
}
