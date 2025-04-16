<?php

namespace Tests\Feature\Mobile\Ad\Rent;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\Land;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateAdExhibitionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_a_exhibition_ad_successfully()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $token = auth('api')->login($user);

        // Create a category for "land"
        $category = Category::factory()->create([
            'id' => 22,
            'adable' => "App\Models\Exhibition",
        ]);

        // Create a sample land ad to update
        $ad = Ad::factory()->create([
            'category_id' => $category->id,
            'price' => 1000,
            'area' => 500,
            'for_rent' => 1, // Set for rent
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
            'renting_duration' => 2,
            'water_supply' => true,
            'electricity_supply' => true,
            'sewerage_supply' => true,
            'description' => 'Updated description',
        ];

        // Send a PUT request to update the land ad
        $response = $this->postJson("api/m/real-estates/update/$ad->id", $updatedData, [
            'Authorization' => "Bearer $token",
        ]);

        // Assert that the response status is 200 (successful)
        $response->assertStatus(Response::HTTP_OK);

        // Assert that the ad was updated with the correct values
        $ad->refresh();
        $this->assertEquals($updatedData['price'], $ad->price);
        $this->assertEquals($updatedData['area'], $ad->area);
        $this->assertEquals($updatedData['description'], $ad->description);

        // Assert that the adable (Room) was updated correctly
        $adable = $ad->adable;
        $this->assertEquals($updatedData['water_supply'], $adable->water_supply);
        $this->assertEquals($updatedData['electricity_supply'], $adable->electricity_supply);
        $this->assertEquals($updatedData['sewerage_supply'], $adable->sewerage_supply);

        $this->assertDatabaseCount('ads', 1);
        $this->assertDatabaseCount('exhibitions', 1);
    }
}
