<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserApiTest extends TestCase
{
   use RefreshDatabase;

    // ----------------------------------------
    // SUCCESSFUL LOGIN
    // ----------------------------------------
    #[Test]
    public function user_can_login_with_correct_credentials()
    {
        $email = fake()->safeEmail();
        $password = fake()->password();
        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->postJson('/api/user/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertOk()
                 ->assertJsonStructure([
                     'user' => [
                         'id',
                         'name',
                         'email',
                     ],
                     'token',
                 ])
                 ->assertJsonPath('user.email', $email);

        $this->assertNotNull($response->json('token'));
    }

    // ----------------------------------------
    // FAILED LOGIN
    // ----------------------------------------
    #[Test]
    public function user_cannot_login_with_wrong_password()
    {
        $email = fake()->safeEmail();
        $password = fake()->password();
        $user = User::factory()->create([
            'email' => $email,
            'password' => $password,
        ]);

        $response = $this->postJson('/api/user/login', [
            'email' => $email,
            'password' => $password . 'wrong',
        ]);

        $response->assertUnauthorized()
                 ->assertJson([
                     'message' => 'Invalid email or password',
                 ]);
    }

    #[Test]
    public function user_cannot_login_with_nonexistent_email()
    {
        $email = fake()->safeEmail();
        $password = fake()->password();

        $response = $this->postJson('/api/user/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertUnauthorized()
                 ->assertJson([
                     'message' => 'Invalid email or password',
                 ]);
    }
}
