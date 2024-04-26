<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_users_are_displayed(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->getJson('/api/users');

        // Assert
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
        ]);
        $response->assertStatus(200);

        /**
         * Assert that the response contains the given JSON data anywhere in the response:
         * https://laravel.com/docs/10.x/http-tests#assert-json-fragment
         *
         * This is similar to assertJson(), which check the whole json reponse
         * assertJsonFragment() only check one small part of the json response.
         */
        $response->assertJsonFragment(
            [
                'name' => $user->name,
            ]
        );


    }
}
