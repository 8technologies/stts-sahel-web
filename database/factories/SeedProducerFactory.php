<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeedProducer>
 */
class SeedProducerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'producer_registration_number' =>  $this->faker->randomNumber(),
            'producer_category' =>$this->faker->randomElement(['Individual-grower','Seed-breeder','Seed-Company']),
            'name_of_applicant' =>$this->faker->name(),
            'applicant_phone_number' =>$this->faker->phoneNumber(),
            'applicant_email' => $this->faker->unique()->email(),
            'premises_location' =>$this->faker->address(),
            'proposed_farm_location' => $this->faker->address(),
            'years_of_experience' => $this->faker->randomNumber(),
            'gardening_history_description' => $this->faker->sentence(),
            'storage_facilities_description' => $this->faker->sentence(),
            'have_adequate_isolation' => $this->faker->boolean(),
            'labor_details' =>$this->faker->sentence(),
            'receipt' =>$this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['pending','accepted','rejected']),
            'status_comment'=> $this->faker->sentence(),
            'valid_from' => Carbon::now(),
            'valid_until' => Carbon::now()->addYear(),
            'grower_number' => $this->faker->randomNumber(),
            'inspector_id'=> User::factory(),

            //
        ];
    }
}
