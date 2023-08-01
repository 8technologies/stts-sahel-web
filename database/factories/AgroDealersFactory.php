<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AgroDealers>
 */
class AgroDealersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'applicant_id'=> User::factory(),
            'agro_dealer_reg_number' => $this->faker->unique()->randomNumber(6),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'physical_address' => $this->faker->address,
            'district' => $this->faker->city,
            'circle' => $this->faker->word,
            'township' => $this->faker->word,
            'town_plot_number' => $this->faker->buildingNumber,
            'shop_number' => $this->faker->buildingNumber,
            'company_name' => $this->faker->company,
            'retailers_in' => $this->faker->sentence,
            'business_registration_number' => $this->faker->optional()->randomNumber(6),
            'years_in_operation' => $this->faker->numberBetween(1, 30),
            'business_description' => $this->faker->paragraph,
            'trading_license_number' => $this->faker->randomNumber(6),
            'trading_license_period' => $this->faker->randomElement(['1 year', '2 years', '3 years']),
            'insuring_authority' => $this->faker->company,
            'attachments_certificate' => $this->faker->imageUrl(200, 200, 'business'),
            'proof_of_payment' => $this->faker->imageUrl(200, 200, 'business'),
        ];
    }
}
