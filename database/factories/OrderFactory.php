<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\FaceBuilding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'for_rent' => 1,
            'renting_duration' => "0",
            'category_id' => Category::factory()->create()->id,
            'meter_price' => $this->faker->numberBetween(100, 1000),
            'price_from' => $this->faker->numberBetween(100, 1000),
            'price_to' => $this->faker->numberBetween(100, 1000),
            'area_from' => $this->faker->numberBetween(100, 1000),
            'area_to' => $this->faker->numberBetween(100, 1000),
            'map_latitude' => $this->faker->latitude(),
            'map_longitude'  => $this->faker->longitude(),
            'description' => $this->faker->text(),
            'orderable_type' => $this->faker->randomElement(['App\Models\Room', 'App\Models\Land', 'App\Models\Apartment', 'App\Models\Villa', 'App\Models\Shop']),
            'orderable_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'property_age' => $this->faker->numberBetween(1, 100),
            'street_width_from' => $this->faker->numberBetween(1, 200),
            'street_width_to' => $this->faker->numberBetween(1, 200),
            'property_age_from' => $this->faker->numberBetween(1, 100),
            'property_age_to' => $this->faker->numberBetween(1, 100),
            'face_building_id' => FaceBuilding::factory()->create()->id,
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->numberBetween(0, 2),
            'map_address' => $this->faker->address(),

        ];
    }
}
