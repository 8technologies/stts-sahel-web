<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cooperative>
 */
class CooperativeFactory extends Factory
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
            'user_id'=> User::factory(),
            'cooperative_number' => $this->faker->unique()->randomNumber(6),
            'cooperative_name' => $this->faker->company,
            'registration_number' => $this->faker->optional()->randomNumber(6),
            'cooperative_physical_address' => $this->faker->address,
            'contact_person_name' => $this->faker->name,
            'contact_phone_number' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->optional()->safeEmail,
            'membership_type' => $this->faker->randomElement(['gold', 'silver', 'bronze']),
            'services_to_members' => $this->faker->sentence,
            'objectives_or_goals' => $this->faker->paragraph,
        ];
    }
}
