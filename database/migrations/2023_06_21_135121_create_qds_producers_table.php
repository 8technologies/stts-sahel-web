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
        Schema::create('qds_producers', function (Blueprint $table) {
            $table->id();
            $table->string('qds_producer_number');
            $table->string('name_of_applicant');
            $table->string('applicant_phone_number')->nullable();
            $table->string('applicant_email')->nullable();
            $table->string('applicant_physical_address');
            $table->string('farm_location');
            $table->unsignedBigInteger('years_of_experience');
            $table->string('crop_and_variety_experience');
            $table->string('production_of');
            $table->enum('has_adequate_land', ['Yes', 'No']);
            $table->enum('has_adequate_storage', ['Yes', 'No']);
            $table->enum('has_adequate_equipment', ['Yes', 'No']);
            $table->enum('has_contractual_agreement', ['Yes', 'No']);
            $table->enum('has_field_officers', ['Yes', 'No']);
            $table->enum('has_knowledgeable_personnel', ['Yes', 'No']);
            $table->integer('land_size');
            $table->text('quality_control_mechanisms');
            $table->string('receipt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qds_producers');
    }
};
