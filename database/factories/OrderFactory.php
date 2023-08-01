<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PreOrder;
use App\Models\Quotation;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'preorder_id' => PreOrder::factory(),
            'quotation_id' => Quotation::factory(),
            'quantity' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(2, 10, 100), // Random float between 10 and 100 with 2 decimal places
            'supply_date' => $this->faker->date(),
            'order_by' => User::factory(),
            'supplier'=> User::factory(),
            'details' => $this->faker->text,
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped','delivered']),
            'status_comment' => $this->faker->sentence,
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash_on_delivery']),
            'order_number' => $this->faker->uuid,
            'order_date' => $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
        ];
    }
}
