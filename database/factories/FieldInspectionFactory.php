<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CropDeclaration;
use App\Models\CropVariety;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FieldInspection>
 */
class FieldInspectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'field_inspection_form_number' => $this->faker->unique()->randomNumber(),
            'crop_declaration_id' =>  CropDeclaration::factory(),
            'crop_variety_id' => CropVariety::factory(),
            'inspection_type_id' => $this->faker->randomNumber(),
            'applicant_id' => User::factory(),
            'physical_address' => $this->faker->address(),
            'type_of_inspection' => $this->faker->word(),
            'field_size' => $this->faker->randomFloat(2, 1, 100),
            'seed_generation' => $this->faker->word(),
            'crop_condition' => $this->faker->word(),
            'field_spacing' => $this->faker->word(),
            'estimated_yield' => $this->faker->randomFloat(2, 1, 1000),
            'remarks' => $this->faker->sentence(),
            'inspector_id' => User::factory(),
            'signature' => $this->faker->imageUrl(200, 200),
            'field_decision' => $this->faker->word(),
            'is_active' => $this->faker->boolean(),
            'is_done' => $this->faker->boolean(),
            'inspection_date' => $this->faker->date(),
            'created_at' => now(),
            'updated_at' => now(),
            
        ];
    }
}
