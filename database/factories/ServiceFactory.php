<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => $this->faker->numberBetween(5,7),
            'name_uz' => $this->faker->name(),
            'name_en' => $this->faker->name(),
            'name_ru' => $this->faker->name(),
            'info_uz' => $this->faker->text(),
            'info_en' => $this->faker->text(),
            'info_ru' => $this->faker->text(),
        ];
    }
}
