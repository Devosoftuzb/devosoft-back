<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio_Category>
 */
class Portfolio_CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_uz' => $this->faker->word,
            'name_en' => $this->faker->word,
            'name_ru' => $this->faker->word,
        ];
    }
}
