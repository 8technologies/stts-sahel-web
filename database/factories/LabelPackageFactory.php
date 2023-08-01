<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabelPackage>
 */
class LabelPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'price' => $this->faker->randomFloat(2, 10, 100), // Generates a random float between 10 and 100 with 2 decimal places.
            'quantity' => $this->faker->randomNumber(2),
        ];
    }
}
