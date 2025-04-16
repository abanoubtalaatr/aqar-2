<?php

namespace Tests\Feature\Mobile\Ad\RentByDayOrMonth\Update;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\FaceBuilding;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateRoomTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_update_rent_ad_room_by_month_or_day_successfully()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $token = auth('api')->login($user);

        // Create a category for "farm"
        $category = Category::factory()->create([
            'id' => 13,
            'adable' => "App\Models\Room",
        ]);

        $ad = Ad::factory()->create([
            'map_address' => '123 Main St',
            'map_latitude' => 37.7749,
            'map_longitude' => -122.4194,
        ]);

        // Prepare the request data to update the ad
        $updatedData = [
            'category_id' => $category->id,
            'price' => 1000,
            'area' => 500,
            'for_rent' => 1, // Set for rent
            'length' => 100,
            'width' => 50,
            'street_width' => 20,
            'property_age' => 20,
            'face_building_id' => FaceBuilding::factory()->create()->id,
            'renting_duration' => 1,
            'for_rent' => 1,
            'purpose' => 0,
            'number_of_rooms' => 10,
            'number_of_halls' => 12,
            'number_of_bathrooms' => 5,
            'description' => 'Spacious villa for building',
            'water_supply' => true,
            'electricity_supply' => true,
            'sewerage_supply' => true,
            'per_day_or_month' => 1
        ];

        // Send a PUT request to update the buildings ad
        $response = $this->putJson("api/m/real-estates-rent-by-day-or-month/$ad->id", $updatedData, [
            'Authorization' => "Bearer $token",
        ]);

        // Assert that the response status is 200 (successful)
        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('ads', [
            'per_day_or_month' => 1
        ]);
        // Assert that the ad was updated with the correct values
        $this->assertDatabaseCount('ads', 1);
        $this->assertDatabaseCount('rooms', 1);
    }
}
