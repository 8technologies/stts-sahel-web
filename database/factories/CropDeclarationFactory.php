<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CropDeclaration>
 */
class CropDeclarationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'applicant_id' => $this->faker->numberBetween(1, 3),
            'phone_number' => $this->faker->numberBetween(1, 3),
            'applicant_registration_number' => $this->faker->numberBetween(1, 100),
            'seed_producer_id' => $this->faker->numberBetween(1, 100),
            'garden_size' => $this->faker->numberBetween(1, 100),
            'gps_coordinates_1' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
