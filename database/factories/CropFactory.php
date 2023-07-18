<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crop>
 */
class CropFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'crop_name' => $this->faker->word(),
            'crop_code' => $this->faker->word(),
            'number_of_days_before_submission' => $this->faker->numberBetween(1, 30),
            'seed_viability_period' => $this->faker->numberBetween(1, 365),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
