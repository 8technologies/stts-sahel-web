<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crop_declarations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('seed_producer_id')->nullable();
            $table->unsignedBigInteger('crop_variety_id');
            $table->string('phone_number');
            $table->decimal('garden_size', 8, 2);
            $table->decimal('gps_coordinates_1', 10, 6);
            $table->decimal('gps_coordinates_2', 10, 6);
            $table->decimal('gps_coordinates_3', 10, 6);
            $table->decimal('gps_coordinates_4', 10, 6);
            $table->string('field_name');
            $table->string('district_region');
            $table->string('circle');
            $table->string('township');
            $table->string('village');
            $table->date('planting_date');
            $table->integer('quantity_of_seed_planted');
            $table->integer('expected_yield');
            $table->string('seed_supplier_name');
            $table->string('seed_supplier_registration_number');
            $table->string('source_lot_number');
            $table->string('origin_of_variety');
            $table->decimal('garden_location_latitude', 10, 6);
            $table->decimal('garden_location_longitude', 10, 6);
            $table->string('status');
            $table->unsignedInteger('inspector_id')->nullable();
            $table->string('lot_number')->nullable();
            $table->string('remarks')->nullable();
            $table->string('details')->nullable();
            
            $table->timestamps();

            $table->foreign('seed_producer_id')->references('id')->on('seed_producers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('crop_variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');

         
        

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_declarations');
    }

    
};
