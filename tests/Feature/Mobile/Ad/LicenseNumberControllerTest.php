<?php

namespace Tests\Feature\Mobile\Ad;

use App\Models\Ad;
use App\Models\User;
use App\Services\RandomImageForAdService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LicenseNumberControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the LicenseNumberController functionality.
     *
     * @return void
     */
    public function test_license_number_controller_creates_ad_successfully()
    {
        // Arrange: Mock the RandomImageForAdService
        $this->mock(RandomImageForAdService::class, function ($mock) {
            $mock->shouldReceive('generate')->once();
        });

        // Arrange: Create a user
        $user = User::factory()->create();

        // Arrange: Generate a JWT token for the user
        $token = auth('api')->login($user);

        // Arrange: Provide valid request data
        $data = [
            'license_number' => '12323243',
        ];

        // Act: Make a POST request to the route with the token
        $response = $this->postJson(route('real-estates.license-number'), $data, [
            'Authorization' => "Bearer $token",
        ]);

        // Assert: Check the response
        $response->assertStatus(200);

        // Assert: Verify the ad was created in the database
        $this->assertDatabaseHas('ads', [
            'license_number' => '12323243',
            'user_id' => $user->id,
        ]);
    }


    /**
     * Test validation failure in LicenseNumberController.
     *
     * @return void
     */
    public function test_license_number_controller_validation_failure()
    {
        // Arrange: Create a user
        $user = User::factory()->create();

        // Arrange: Generate a JWT token for the user
        $token = auth('api')->login($user);

        // Arrange: Provide invalid request data (e.g., missing required fields)
        $data = [
            'title' => '',
            'description' => 'Test description',
        ];

        // Act: Make a POST request to the route with the token
        $response = $this->postJson(route('real-estates.license-number'), $data, [
            'Authorization' => "Bearer $token",
        ]);

        // Assert: Check the response
        $response->assertStatus(400)
        ->assertJsonStructure([
            'status',
            'msg',
            'is_verify',
        ]);
    }
}
