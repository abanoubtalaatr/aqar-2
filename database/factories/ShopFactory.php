<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
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
            'water_supply' => $this->faker->boolean(),
            'electricity_supply' => $this->faker->boolean(),
            'sewerage_supply' => $this->faker->boolean(),
            'street_width_from' => $this->faker->numberBetween(1, 200),
            'street_width_to' => $this->faker->numberBetween(1, 200),
        ];
    }
}
