<?php

namespace Tests\Feature\Mobile\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginWithDeviceIdControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Run any additional setup needed here
    }

    /** @test */
    public function it_logs_in_successfully_with_valid_device_id_and_email()
    {
        // Arrange: Create a user with a device_id
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'device_id' => 'valid-device-id',
        ]);

        $payload = [
            'email' => 'testuser@example.com',
            'device_id' => 'valid-device-id',
        ];

        // Act: Make the request to login with device id
        $response = $this->postJson('api/m/login-with-device-id', $payload);

        // Assert: Check for successful login response
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'email',
                         'name',
                         'token',
                         'created_at',
                     ],
                     'msg',
                     'status'
                 ]);
    }

    /** @test */
    public function it_fails_login_with_invalid_device_id_or_email()
    {
        // Arrange: Create a user with a specific device_id
        User::factory()->create([
            'email' => 'testuser@example.com',
            'device_id' => 'valid-device-id',
        ]);

        // Invalid email
        $payload = [
            'email' => 'wrongemail@example.com',
            'device_id' => 'valid-device-id',
        ];

        // Act: Attempt login with invalid email
        $response = $this->postJson('api/m/login-with-device-id', $payload);

        // Assert: Check for failed login response
        $response->assertStatus(401)
                 ->assertJson([
                     'msg' => __('mobile.Invalid credentials.')
                 ]);

        // Invalid device ID
        $payload['email'] = 'testuser@example.com';
        $payload['device_id'] = 'wrong-device-id';

        // Act: Attempt login with invalid device_id
        $response = $this->postJson('api/m/login-with-device-id', $payload);

        // Assert: Check for failed login response
        $response->assertStatus(401)
                 ->assertJson([
                     'msg' => __('mobile.Invalid credentials.')
                 ]);
    }

    /** @test */
    public function it_fails_login_when_user_with_device_id_does_not_exist()
    {
        // Arrange: No users in database

        $payload = [
            'email' => 'nonexistent@example.com',
            'device_id' => 'nonexistent-device-id',
        ];

        // Act: Attempt login with non-existent user
        $response = $this->postJson('api/m/login-with-device-id', $payload);

        // Assert: Check for failed login response
        $response->assertStatus(401)
                 ->assertJson([
                     'msg' => __('mobile.Invalid credentials.')
                 ]);
    }
}
