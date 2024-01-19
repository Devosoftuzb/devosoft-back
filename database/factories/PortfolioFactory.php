<?php

namespace Database\Factories;

use App\Models\Portfolio_Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'portfolio__category_id' => function () {
                return Portfolio_Category::factory()->create()->id;
            },
            'name' => $this->faker->name,
            'link' => $this->faker->word,
            'image' => $this->faker->imageUrl(640, 480, 'animals'),
        ];
    }
}
