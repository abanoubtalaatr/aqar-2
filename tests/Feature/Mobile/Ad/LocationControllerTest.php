<?php

namespace Tests\Feature\Mobile\Ad;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful location update for an ad.
     *
     * @return void
     */
    public function test_location_controller_updates_ad_successfully()
    {
        // Arrange: Create a user
        $user = User::factory()->create();

        // Arrange: Create an ad that belongs to the user
        $ad = Ad::factory()->create([
            'user_id' => $user->id,
            'license_number' => '12323243', // or any other required fields
        ]);

        // Arrange: Generate a JWT token for the user
        $token = auth('api')->login($user);

        // Arrange: Provide valid request data (location-related fields)
        $data = [
            'map_latitude' => '40.748817',
            'map_longitude' => '-73.985428',
        ];

        $this->handleValidationExceptions();
        // Act: Make a POST request to update the ad's location
        $response = $this->postJson(route('real-estates.location', ['id' => $ad->id]), $data, [
            'Authorization' => "Bearer $token",
        ]);

        // Assert: Check the response
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'msg' => __('api.Ad updated successfully.')
            ]);

        // Assert: Verify the ad's location was updated in the database
        $this->assertDatabaseHas('ads', [
            'id' => $ad->id,
            'map_latitude' => '40.748817',
            'map_longitude' => '-73.985428',
        ]);
    }

    /**
     * Test location update fails when the ad is not found.
     *
     * @return void
     */
    public function test_location_controller_ad_missing_location()
    {
        // Arrange: Create a user
        $user = User::factory()->create();

        // Arrange: Generate a JWT token for the user
        $token = auth('api')->login($user);

        // Arrange: Provide valid request data (location-related fields)
        $data = [];

        // Act: Make a POST request to update the location
        $response = $this->postJson(route('real-estates.location', ['id' => 99999]), $data, [
            'Authorization' => "Bearer $token",
        ]);

        // Assert: Check the response status
        $response->assertStatus(400);

        // Assert: Check that the error message for map_latitude is returned
        $response->assertJson([
            'status' => false,
            'msg' => 'حقل الموقع مطلوب.',
            'is_verify' => true,
        ]);
    }
}
