<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Land>
 */
class LandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purpose' => $this->faker->numberBetween(0, 2),
            'street_width' => $this->faker->numberBetween(1, 200),
            'water_supply' => $this->faker->boolean(),
            'electricity_supply' => $this->faker->boolean(),
            'sewerage_supply' => $this->faker->boolean(),
            'price_meter' => $this->faker->numberBetween(1, 200),
            'price_meter_from' => $this->faker->numberBetween(1, 200),
            'price_meter_to' => $this->faker->numberBetween(1, 200),
        ];
    }
}
