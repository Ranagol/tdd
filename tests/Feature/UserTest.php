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
        $response = $this->get('/users');

        // Assert
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
        ]);
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }
}
