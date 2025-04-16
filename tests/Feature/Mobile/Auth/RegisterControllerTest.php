<?php

namespace Tests\Feature\Mobile\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Mock the mailer to avoid sending real emails
        Mail::fake();
    }

    /** @test */
    public function it_registers_a_user_successfully()
    {
        // Arrange: Create payload with valid data
        $payload = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'phone' => '01014636418',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Act: Make a POST request to the register endpoint
        $response = $this->postJson('api/m/register', $payload);

        // Assert: Check that the response status is 200 and that the user is created
        $response->assertStatus(200)
                 ->assertJson([
                     'msg' => __('mobile.Verification code sent to your email, Please verify your email.')
                 ]);

        // Assert: Check that the user was created in the database
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'name' => 'Test User',
            'phone' => '01014636418',
            // Ensure verification_code is saved
            'verification_code' => 1234,
        ]);

        // Assert: Check that an email with the verification code was "sent"
        // Mail::assertSent(\App\Mail\VerifyEmail::class, function ($mail) use ($payload) {
        //     return $mail->hasTo($payload['email']);
        // });
    }

    /** @test */
    public function it_fails_registration_with_missing_fields()
    {
        // Arrange: Create an incomplete payload
        $payload = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            // 'password' is missing
        ];

        // Act: Make the request
        $response = $this->postJson('api/m/register', $payload);

        // Assert: Check that the response status is 400 and contains validation errors
        $response->assertStatus(400);
    }


    /** @test */
    public function it_fails_registration_with_invalid_email()
    {
        // Arrange: Create payload with invalid email
        $payload = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Act: Make the request
        $response = $this->postJson('api/m/register', $payload);

        // Assert: Check for validation error on email field
        $response->assertStatus(400);
    }

    /** @test */
    public function it_fails_registration_when_passwords_do_not_match()
    {
        // Arrange: Create payload with mismatched password and password_confirmation
        $payload = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password456', // Mismatched
        ];

        // Act: Make the request
        $response = $this->postJson('api/m/register', $payload);

        // Assert: Check for validation error on password_confirmation field
        $response->assertStatus(400);
    }
}
