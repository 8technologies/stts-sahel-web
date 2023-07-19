<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CropVariety;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PreOrder>
 */
class PreOrderFactory extends Factory
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
            'user_id' => User::factory(),
            'crop_variety_id' => CropVariety::factory(),
            'seed_class' => $this->faker->randomElement(['A', 'B', 'C']),
            'quantity' => $this->faker->numberBetween(1, 100),
            'preferred_delivery_date' => $this->faker->date,
            'order_date' => $this->faker->date,
            'client_name' => $this->faker->name,
            'client_physical_address' => $this->faker->address,
            'client_contact_number' => $this->faker->phoneNumber,
            'client_email_address' => $this->faker->unique()->safeEmail,
            'preferred_payment_method' => $this->faker->randomElement(['Credit Card', 'Bank Transfer', 'Cash on Delivery']),
            'proof_of_payment' => $this->faker->imageUrl(200, 200, 'business'),
            'seed_delivery_preferences' => $this->faker->paragraph,
            'other_information' => $this->faker->paragraph,

        ];
    }
}
