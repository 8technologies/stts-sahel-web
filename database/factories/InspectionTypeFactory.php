<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Crop;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InspectionType>
 */
class InspectionTypeFactory extends Factory
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
            'inspection_type_name' =>$this->faker->randomElement(['preflowering', 'harvesting','postharvesting','seedling','flowering','maturity','preplanting','postplanting']),
            'order' => $this->faker->numberBetween(1, 8),
            'period_after_planting' => $this->faker->numberBetween(7, 30),
            'crop_id'=> Crop::factory(),
        ];
    }
}
