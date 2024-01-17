<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name_uz' => $this->faker->word,
            'name_en' => $this->faker->word,
            'name_ru' => $this->faker->word,
            'info_uz' => $this->faker->paragraph,
            'info_en' => $this->faker->paragraph,
            'info_ru' => $this->faker->paragraph,
        ];
    }
}
