<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CropDeclaration;
use App\Models\User; 
use App\Models\CropVariety;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoadStock>
 */
class LoadStockFactory extends Factory
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
            'load_stock_number' => $this->faker->unique()->randomNumber(),
            'crop_declaration_id' =>CropDeclaration::factory(),
            'crop_variety_id' => CropVariety::factory(),
            'applicant_id' =>User::factory(),
            'registration_number' =>$this->faker->unique()->randomNumber(),
            'seed_class' =>$this->faker->word(),
            'field_size' =>$this->faker->randomFloat(2, 1, 100),
            'yield_quantity' =>$this->faker->randomFloat(2, 1, 1000),
            'last_field_inspection_date' =>$this->faker->date(),
            'load_stock_date' =>$this->faker->date(),
            'last_field_inspection_remarks' =>$this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
