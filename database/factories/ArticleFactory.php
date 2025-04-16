<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city_id' => $this->faker->numberBetween(79, 97),
            'title_ar' => $this->faker->sentence(),
            'title_en' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'description_ar' => $this->faker->sentence(),
            'description_en' => $this->faker->sentence(),
        ];
    }
}
