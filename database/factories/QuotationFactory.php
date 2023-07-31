<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PreOrder;
use App\Models\Quotation;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quotation>
 */
class QuotationFactory extends Factory
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
            'preorder_id' => PreOrder::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 10, 100), // Random float between 10 and 100 with 2 decimal places
            'supply_date' => $this->faker->date(),
            'quotation_by' => User::factory(),
            'quotation_to' => User::factory(),
            'details' => $this->faker->text,
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash_on_delivery']),
            'status_comment' => $this->faker->sentence,
        ];
    }
}
