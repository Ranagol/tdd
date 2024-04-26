<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function testUsersIndexWorks(): void
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

    public function testUserShowWorks(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->getJson('/api/users/' . $user->id);

        // Assert
        $response->assertOk();
        $response->assertStatus(200);
        $response->assertJsonFragment(
            [
                'name' => $user->name,
            ]
        );

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json
                ->where('name', $user->name)
                ->missing('password')
                ->etc()
        );
    }

    public function testUserEditWorks(): void
    {
        // Arrange
        $user = User::factory()->create();
        $newName = $this->faker->name;
        $newEmail = $this->faker->email;

        // Act
        $response = $this->putJson(
            '/api/users/' . $user->id,
            [
                'name' => $newName,
                'email' => $newEmail,
            ]
        );

        // Assert
        $response->assertOk();

        //Assert database has the new name and email
        $this->assertDatabaseHas('users', [
            'name' => $newName,
            'email' => $newEmail,
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
