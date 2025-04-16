<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
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
            'number_of_bathrooms' => $this->faker->numberBetween(1, 20),
            'floor_number' => $this->faker->numberBetween(1, 20),
            'furnished' => $this->faker->boolean(),
            'kitchen' => $this->faker->boolean(),
            'two_entrance' => $this->faker->boolean(),
            'sewerage_supply' => $this->faker->boolean(),
            'electricity_supply' => $this->faker->boolean(),
            'water_supply' => $this->faker->boolean(),
            'car_entrance' => $this->faker->boolean(),
            'elevator' => $this->faker->boolean(),
            'number_of_halls' => $this->faker->numberBetween(1, 20),
            'purpose' => $this->faker->numberBetween(1, 3),
        ];
    }
}
