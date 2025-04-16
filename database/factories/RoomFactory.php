<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kitchen' => $this->faker->boolean(),
            'furnished' => $this->faker->boolean(),
            'street_width' => $this->faker->numberBetween(1, 200),
            'water_supply' => $this->faker->boolean(),
            'electricity_supply' => $this->faker->boolean(),
            'sewerage_supply' => $this->faker->boolean(),
            'floor_number' => $this->faker->numberBetween(1, 20),
            'has_elevator' => $this->faker->boolean(),
        ];
    }
}
