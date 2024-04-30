<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @return void
     */
    public function testForShowMethodUserNotFound404()
    {
        $response = $this->get('/api/user/1');

        $response->assertStatus(404);
    }

    // public function testUpdateUserWithNotValidEmail()
    // {
    //     $user = User::factory()->create();

    //     $response = $this->put("/api/user/{$user->id}", ['email' => 'not an email']);

    //     $response->assertStatus(422);
    // }

    // //* //THIS IS NOT FINISHED
    // public function testStoreUserWithNotValidEmail()
    // {
    //     $response = $this->post('/api/user', ['email' => 'not an email']);

    //     $response->assertStatus(422);
    // }

    public function testDestroyUserNotFound()
    {
        $response = $this->delete('/api/user/1');

        $response->assertStatus(404);
    }
}
