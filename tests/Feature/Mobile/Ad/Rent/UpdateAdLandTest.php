<?php

namespace Tests\Feature\Mobile\Ad\Rent;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\Land;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateAdLandTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    /** @test */
    public function it_updates_a_land_ad_successfully()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $token = auth('api')->login($user);

        // Create a category for "land"
        $category = Category::factory()->create([
            'id' => 2,
            'adable' => get_class(Land::factory()->create()),
        ]);


        // Create a sample land ad to update
        $ad = Ad::factory()->create([
            'category_id' => $category->id,
            'for_rent' => 1, // Set for rent
            'price' => 1000,
            'area' => 500,
            'length' => 100,
            'width' => 50,
            'description' => 'Spacious land for rent',
        ]);

        // Prepare the request data to update the ad
        $updatedData = [
            'category_id' => $category->id,
            'price' => 1500,
            'area' => 600,
            'length' => 120,
            'width' => 60,
            'street_width' => 25,
            'purpose' => '0',
            'description' => 'Updated commercial land for rent',
            'for_rent' => 1,
            'price_meter' => 30,
            'water_supply' => true,
            'electricity_supply' => true,
            'sewerage_supply' => true,
        ];
        $this->handleValidationExceptions();
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
        $this->assertEquals($updatedData['length'], $ad->length);
        $this->assertEquals($updatedData['width'], $ad->width);
        $this->assertEquals($updatedData['description'], $ad->description);

        // Assert that the adable (Land) was updated correctly
        $adable = $ad->adable;
        $this->assertEquals($updatedData['price_meter'], $adable->price_meter);
        $this->assertEquals($updatedData['water_supply'], $adable->water_supply);
        $this->assertEquals($updatedData['electricity_supply'], $adable->electricity_supply);
        $this->assertEquals($updatedData['sewerage_supply'], $adable->sewerage_supply);
    }
}
