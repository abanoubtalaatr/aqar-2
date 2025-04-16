<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'adable' => $this->faker->randomElement([
                "App\Models\Room",
                "App\Models\Apartment",
                "App\Models\Villa"
            ]),
            'key' => $this->faker->name(),
            'name_ar' => $this->faker->name(),
            'name_en' => $this->faker->name(),
            'max_rent_price' => $this->faker->numberBetween(1, 100),
            'min_rent_price' => $this->faker->numberBetween(1, 100),
            'max_sell_price' => $this->faker->numberBetween(1, 100),
            'min_sell_price' => $this->faker->numberBetween(1, 100),
            'search_orders' => $this->faker->numberBetween(1, 100),
        ];
    }
}
