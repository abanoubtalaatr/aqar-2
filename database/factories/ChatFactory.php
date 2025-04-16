<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ad_id' => Ad::factory()->create(),
            'sender_id' => User::factory()->create()->id,
            'receiver_id' => User::factory()->create()->id,
            'receiver_read_at' => now(),
            'sender_read_at' => now(),
            'message' => $this->faker->sentence(),
            'is_closed' => false,
        ];
    }
}
