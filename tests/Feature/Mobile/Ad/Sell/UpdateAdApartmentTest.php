<?php

namespace Tests\Feature\Mobile\Ad\Sell;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Apartment;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateAdApartmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function it_updates_an_ad_successfully_for_apartment_rent()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $token = auth('api')->login($user);

        // Create a category for "apartment"
        $category = Category::factory()->create([
            'adable' => get_class(Apartment::factory()->create()),
        ]);

        // Create a sample ad to update
        $ad = Ad::factory()->create([
            'category_id' => $category->id,
            'for_rent' => 0, // Set for sell
            'price' => 1000,
            'area' => 50,
            'property_age' => 5,
            'description' => 'Spacious apartment',
        ]);

        // Prepare the request data to update the ad
        $updatedData = [
            'category_id' => $category->id,
            'price' => 1200,
            'area' => 60,
            'street_width' => 12,
            'property_age' => 6,
            'purpose' => 1,
            'floor_number' => 3,
            'number_of_rooms' => 4,
            'number_of_halls' => 2,
            'number_of_bathrooms' => 3,
            'furnished' => true,
            'elevator' => true,
            'water_supply' => true,
            'electricity_supply' => true,
            'sewerage_supply' => true,
            'description' => 'Updated apartment description',
            'for_rent' => 0,
        ];

        // Send a PUT request to the update endpoint
        $response = $this->postJson("api/m/real-estates/update/$ad->id", $updatedData, [
            'Authorization' => "Bearer $token",
        ]);

        // Assert that the response status is 200 (successful)
        $response->assertStatus(Response::HTTP_OK);

        // Assert that the ad was updated with the correct values
        $ad->refresh();
        $this->assertEquals($updatedData['price'], $ad->price);
        $this->assertEquals($updatedData['area'], $ad->area);
        $this->assertEquals($updatedData['property_age'], $ad->property_age);
        $this->assertEquals($updatedData['description'], $ad->description);

        // Assert that the adable (Apartment) was updated correctly
        $adable = $ad->adable;
        $this->assertEquals($updatedData['floor_number'], $adable->floor_number);
        $this->assertEquals($updatedData['number_of_rooms'], $adable->number_of_rooms);
    }


}
