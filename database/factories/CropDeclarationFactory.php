<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SeedProducer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CropDeclaration>
 */
class CropDeclarationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'applicant_id' =>SeedProducer::factory()->create()->user_id,
            'phone_number' => $this->faker->numberBetween(1, 3),
            'applicant_registration_number' => $this->faker->numberBetween(1, 100),
            'seed_producer_id' => SeedProducer::factory(),
            'garden_size' => $this->faker->numberBetween(1, 100),
            'gps_coordinates_1' => $this->faker->randomFloat(6, -90, 90),
            'gps_coordinates_2' => $this->faker->randomFloat(6, -90, 90),
            'gps_coordinates_3' => $this->faker->randomFloat(6, -90, 90),
            'gps_coordinates_4' => $this->faker->randomFloat(6, -90, 90),
            'field_name' => $this->faker->string,
            'district_region' => $this->faker->text,
            'circle' => $this->faker->text,
            'township' => $this->faker->text,
            'village' => $this->faker->text,
            'planting_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'quantity_of_seed_planted' => $this->faker->numberBetween(1, 100),
            'expected_yield' => $this->faker->numberBetween(1, 100),
            'seed_supplier_name' => $this->faker->text,
            'seed_supplier_registration_number' => $this->faker->text,
            'source_lot_number' => $this->faker->numberBetween(1, 100),
            'origin_of_variety' => $this->faker->text,
            'garden_location_latitude' => $this->faker->randomFloat(6, -90, 90),
            'garden_location_longitude' => $this->faker->randomFloat(6, -90, 90),
            'status' => $this->faker->randomElement(['pending','accepted','rejected']),
            'inspector_id' => $this->faker->numberBetween(1, 100),
            'lot_number' => $this->faker->text,

        ];
    }


}
