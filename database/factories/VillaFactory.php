<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Villa>
 */
class VillaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street_width' => $this->faker->numberBetween(1, 200),
            'number_of_rooms' => $this->faker->numberBetween(1, 20),
            'number_of_apartments' => $this->faker->numberBetween(1, 20),
            'number_of_bathrooms' => $this->faker->numberBetween(1, 20),
            'kitchen' => $this->faker->boolean(),
            'furnished' => $this->faker->boolean(),
            'driver_room' => $this->faker->boolean(),
            'maid_room' => $this->faker->boolean(),
            'swimming_pool' => $this->faker->boolean(),
            'car_entrance' => $this->faker->boolean(),
            'elevator' => $this->faker->boolean(),
            'water_supply' => $this->faker->boolean(),
            'electricity_supply' => $this->faker->boolean(),
            'sewerage_supply' => $this->faker->boolean(),
            'purpose' => $this->faker->numberBetween(0, 2),
            'has_cellar' => $this->faker->boolean(),
            'number_of_halls' => $this->faker->numberBetween(1, 20),
            'has_interior_staircase' => $this->faker->boolean(),
            'has_attached' => $this->faker->boolean(),
        ];
    }
}
