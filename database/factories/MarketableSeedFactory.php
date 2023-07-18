<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SeedLab;
use App\Models\LoadStock;
use App\Models\CropVariety;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MarketableSeed>
 */
class MarketableSeedFactory extends Factory
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
                'seed_lab_id' => SeedLab::factory(),
                'load_stock_id' => LoadStock::factory(),
                'crop_variety_id' => CropVariety::factory(),
                'quantity' => $this->faker->numberBetween(1, 100),
                'created_at' => now(),
                'updated_at' => now(),
        ];
    }
}
