<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $user = User::factory()->create();

        $response = $this->post("/api/v1/auth/login", [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'access_token',
            ],
            'status'
        ]);
    }

    public function test_the_application_returns_a_failed_response()
    {
        $user = User::factory()->create();

        $response = $this->post("/api/v1/auth/login", [
            'email' => $user->email,
            'password' => 'wrong_password'
        ]);

        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
            'status'
        ]);
    }

    public function test_the_application_returns_a_failed_response_when_email_is_not_provided()
    {
        $user = User::factory()->create();

        $response = $this->post("/api/v1/auth/login", [
            'email' => $user->email,
        ]);

        $response->assertStatus(422);        $response->assertJsonStructure([
            'message',
            'status'
        ]);
    }
}
