<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SeedLabel;
use App\Models\LabelPackage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeedLabelPackage>
 */
class SeedLabelPackageFactory extends Factory
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
            'seed_label_id' => SeedLabel::factory(),
            'package_id' => LabelPackage::factory(),
            'quantity' =>  $this->faker->numberBetween(1, 100),
        ];
    }
}
