<?php

namespace Tests\Feature\Mobile\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordResetControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Run any additional setup needed here
    }

    public function test_send_email_with_valid_user()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'verification_code' => null,
            'token' => null,
        ]);

        $payload = [
            'email' => 'testuser@example.com',
        ];

        $response = $this->postJson('/api/m/forgot-password/send-email', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);

        $user->refresh();

        $this->assertNotNull($user->token);
        $this->assertEquals(1234, $user->verification_code); // Assuming verification code is always 1234 for tests
    }

    public function test_send_email_with_invalid_user()
    {
        $payload = [
            'email' => 'nonexistent@example.com',
        ];

        $response = $this->postJson('/api/m/forgot-password/send-email', $payload);

        $response->assertStatus(400);
    }

    public function test_reset_password_with_valid_token()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'token' => 'valid-token',
            'phone' => "01014636418",
            'password' => bcrypt('oldpassword'),
            'verification_code' => 1234,
        ]);

        $payload = [
            'email' => 'testuser@example.com',
            'token' => 'valid-token',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword', // Laravel's default field for confirming passwords
            'phone' => "01014636418",
            'verification_code' => 1234,
        ];

        $response = $this->postJson('/api/m/forgot-password/reset-password', $payload);

        $response->assertStatus(200);

        $user->refresh();

        $this->assertTrue(Hash::check('newpassword', $user->password));
        $this->assertNull($user->token);
    }

    public function test_reset_password_with_invalid_token()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'token' => 'valid-token',
        ]);

        $payload = [
            'email' => 'testuser@example.com',
            'token' => 'invalid-token',
            'password' => 'newpassword',
        ];

        $response = $this->postJson('/api/m/forgot-password/reset-password', $payload);

        $response->assertStatus(400);
    }
    public function test_resend_reset_token_with_valid_user()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'verification_code' => null,
            'token' => null,
        ]);

        $payload = [
            'email' => 'testuser@example.com',
        ];

        $response = $this->postJson('/api/m/forgot-password/resend-reset-email', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);

        $user->refresh();

        $this->assertNotNull($user->token);
        $this->assertEquals(1234, $user->verification_code); // Verifying the default test value
    }

    public function test_resend_reset_token_with_invalid_user()
    {
        $payload = [
            'email' => 'nonexistent@example.com',
        ];

        $response = $this->postJson('/api/m/forgot-password/resend-reset-email', $payload);

        $response->assertStatus(400);
    }
}
