<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversion>
 */
class ConversionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'integer_value' => fake()->numberBetween(1, 3999),
            'roman_numeral' => fake()->regexify('[IVXLCDM]{1,5}')
        ];
    }
}
