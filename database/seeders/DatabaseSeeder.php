<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    //    \App\Models\Crop::factory(10)->create();
    //    \App\Models\CropVariety::factory(10)->create();
  


    //  \App\Models\SeedProducer::factory(10)->create();
    //  \App\Models\CropDeclaration::factory(10)->create();
    //  \App\Models\LoadStock::factory(10)->create();
    //  \App\Models\SeedLab::factory(10)->create();
    //  \App\Models\MarketableSeed::factory(10)->create();

    //   \App\Models\AgroDealers::factory(10)->create();
    //    \App\Models\Cooperative::factory(10)->create();
       //\App\Models\PreOrder::factory(10)->create();

      // \App\Models\User::factory(10)->create();

    //\App\Models\SeedLabel::factory(10)->create();
    //  \App\Models\SeedLabelPackage::factory(10)->create();
     // \App\Models\Quotation::factory(10)->create();
       \App\Models\Order::factory(10)->create();
  }
}
