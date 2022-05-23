<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
       $user = User::factory()->create();

        $response = $this->get(sprintf("/api/v1/events/search?term=%s&date=%s", "Bison", Carbon::today()->format('Y-m-d')), [
            'Authorization' => 'Bearer ' . $user->createToken('authToken')->plainTextToken,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'events' => [
                    '*' => [
                        'id',
                        'name',
                        'city',
                        'country',
                        'startDate',
                        'endDate',
                    ],
                ],
            ],
        ]);
    }

    public function test_the_application_returns_a_failed_response_when_term_is_not_provided()
    {
        $user = User::factory()->create();

        $response = $this->get("/api/v1/events/search?date=2021-04-30", [
            'Authorization' => 'Bearer ' . $user->createToken('authToken')->plainTextToken,
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'status'
        ]);
    }
}
