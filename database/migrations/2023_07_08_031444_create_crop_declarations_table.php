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
            $table->unsignedBigInteger('crop_variety_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->decimal('garden_size', 8, 2)->nullable();
            $table->string('land_architecture')->nullable();
            $table->string('field_name')->nullable();
            $table->string('district_region')->nullable();
            $table->string('circle')->nullable();
            $table->string('township')->nullable();
            $table->string('village')->nullable();
            $table->date('planting_date')->nullable();
            $table->decimal('quantity_of_seed_planted', 8, 2)->nullable();
            $table->decimal('expected_yield', 8, 2)->nullable();
            $table->string('seed_supplier_name')->nullable();
            $table->string('seed_supplier_registration_number')->nullable();
            $table->string('source_lot_number')->nullable();
            $table->string('origin_of_variety')->nullable();
            $table->decimal('garden_location_latitude', 10, 6)->nullable();
            $table->decimal('garden_location_longitude', 10, 6)->nullable();
            $table->string('status')->nullable();
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
