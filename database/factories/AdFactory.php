<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
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

            'license_number' => '5050',
            'price' => '20',
            'area' => '20',
            'length' => '20',
            'width' => '20',
            'description' => 'string',
            'map_latitude' => '2000',
            'map_longitude' => '5258',
            'is_active' => $this->faker->boolean(),
            'bound_for_sale' => $this->faker->boolean(),
            'advertiser_owner' => $this->faker->boolean(),
        ];
    }
}
