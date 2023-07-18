<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Crop;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CropVariety>
 */
class CropVarietyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'crop_id' => Crop::factory(),
            'crop_variety_name' =>  $this->faker->word(),
            'crop_variety_code' =>  $this->faker->unique()->randomNumber(),
            'crop_variety_generation' => $this->faker->word(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
