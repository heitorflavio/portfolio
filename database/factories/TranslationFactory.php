<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'language' => $this->faker->randomElement(['en', 'pt']),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'translatable_id' => null,
            'translatable_type' => null,
        ];
    }
}
