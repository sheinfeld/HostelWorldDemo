<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\EventSearchRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Traits\ApiResponse;
use Throwable;

class EventController extends ApiController
{
    use ApiResponse;

    /**
     * @OA\Get(
     *     tags={"Authorize"},
     *     path="/events/search",
     *     summary="Search events by city/country and date",
     *     security={{ "Bearer":{} }},
     *     @OA\Parameter(
     *        name="term",
     *        in="path",
     *        description="Search term",
     *        @OA\Schema(
     *           type="string",
     *        ),
     *        required=true,
     *        example="Lisbon"
     *     ),
     *     @OA\Parameter(
     *        name="date",
     *        in="path",
     *        description="Date in the future",
     *        @OA\Schema(
     *           type="date",
     *        ),
     *        required=true,
     *        example="2022-06-21"
     *     ),
     *     @OA\Response(response="200", description="Success", @OA\JsonContent(ref="#/components/schemas/EventResource")),
     *     @OA\Response(response="401", description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/ApiRequestException")),
     *     @OA\Response(response="422", description="Unprocessable Entity", @OA\JsonContent(ref="#/components/schemas/ApiValidationException")),
     *     @OA\Response(response="500", description="Internal Server Error", @OA\JsonContent(ref="#/components/schemas/ApiSystemException"))
     * )
     */
    public function search(EventSearchRequest $request)
    {
        try {
            $events = Event::where('city', 'LIKE', '%' . $request->input('term') . '%')
                ->orWhere('country', 'LIKE', '%' . $request->input('term') . '%')
                ->where('date', $request->input('date'))
                ->get();

            return $this->apiSuccess([
                'events' => EventResource::make($events),
            ]);

        } catch (Throwable $e) {
            return $this->apiError($e->getMessage());
        }
    }
}
