<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\LoadStock;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeedLab>
 */
class SeedLabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sample_request_number' =>$this->faker->unique()->randomNumber(),
            'applicant_id' =>User::factory(),
            'load_stock_id' =>LoadStock::factory(),
            'sample_request_date' =>$this->faker->date(),
            'proof_of_payment' =>$this->faker->word(),
            'applicant_remarks' =>$this->faker->sentence(),
            'priority' =>$this->faker->word(),
            'additional_instructions' =>$this->faker->sentence(),
            'lab_receptionist_id' =>$this->faker->randomNumber(),
            'inspector_id' =>$this->faker->randomNumber(),
            'quantity' =>$this->faker->randomFloat(2, 1, 100),
            'lab_officer_id' =>$this->faker->randomNumber(),
            'reporting_date' =>$this->faker->dateTime(),
            'seed_lab_test_report_number' =>$this->faker->word(),
            'seed_sample_request_number' =>$this->faker->word(),
            'seed_sample_size' =>$this->faker->randomFloat(2, 1, 100),
            'testing_methods' =>$this->faker->sentence(),
            'germination_test_results' =>$this->faker->randomFloat(2, 1, 100),
            'purity_test_results' =>$this->faker->randomFloat(2, 1, 100),
            'moisture_content_test_results' =>$this->faker->randomFloat(2, 1, 100),
            'additional_tests_results' =>$this->faker->sentence(),
            'test_decision' =>$this->faker->randomElement(['marketable','not marketable']),
            'reporting_and_signature' =>$this->faker->sentence(),
            'mother_lot' =>$this->faker->sentence(),
            'lot_number' =>$this->faker->sentence(),
            'created_at' => $this->faker->dateTimeBetween('this year'),
            'updated_at' => now(),
        ];
    }
}
