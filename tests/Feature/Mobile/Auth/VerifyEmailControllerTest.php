<?php

namespace Tests\Feature\Mobile\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerifyEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Run any additional setup needed here
    }

    public function test_register_creates_user_and_sends_verification_code()
    {
        $payload = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '1234567890',
        ];

        $response = $this->postJson('/api/m/register', $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'verification_code' => 1234,
        ]);
    }

    public function test_verify_email_with_correct_verification_code()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'verification_code' => 1234,
        ]);

        $payload = [
            'email' => 'testuser@example.com',
            'verification_code' => 1234,
        ];

        $response = $this->postJson('/api/m/verify-email', $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'email_verified_at' => now(),
            'verification_code' => null,
        ]);
    }
    public function test_resend_verification_email()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'email_verified_at' => null,
        ]);

        $payload = [
            'email' => 'testuser@example.com',
        ];

        $response = $this->postJson('/api/m/resend-verification-code', $payload);

        $response->assertStatus(200);

        $user->refresh();

        $this->assertEquals(1234, $user->verification_code);
    }

}
