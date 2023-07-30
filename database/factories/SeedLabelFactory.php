<?php

namespace Database\Factories;

use App\Models\SeedLab;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeedLabel>
 */
class SeedLabelFactory extends Factory
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
            'seed_label_request_number' => $this->faker->unique()->randomNumber(),
            'applicant_id' => User::factory(),
            'registration_number' => $this->faker->unique()->randomNumber(),
            'seed_lab_id' => SeedLab::factory(),
            'label_packages' => $this->faker->word(),
            'quantity_of_seed' => $this->faker->randomFloat(2, 100, 1000),
            'proof_of_payment' => $this->faker->word(),
            'request_date' => $this->faker->date(),
            'applicant_remarks' => $this->faker->word(),

        ];
    }
}
