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
        Schema::create('field_inspections', function (Blueprint $table) {
            $table->id();
            $table->string('field_inspection_form_number');
            $table->string('crop_declaration_id')->nullable();;
            $table->unsignedBigInteger('crop_variety_id')->nullable();;
            $table->unsignedBigInteger('inspection_type_id')->nullable();;
            $table->string('applicant_id')->nullable();;
            $table->string('physical_address')->nullable();;
            $table->string('type_of_inspection')->nullable();;
            $table->unsignedFloat('field_size')->nullable();;
            $table->string('seed_generation')->nullable();;
            $table->string('crop_condition')->nullable();;
            $table->string('field_spacing')->nullable();;
            $table->unsignedFloat('estimated_yield')->nullable();
            $table->text('remarks')->nullable();
            $table->string('inspector_id')->nullable();
            $table->string('signature')->nullable();
            $table->string('field_decision')->nullable();
            $table->boolean('is_active');
            $table->date('inspection_date')->nullable();
            $table->timestamps();

            $table->foreign('crop_variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');
            $table->foreign('inspection_type_id')->references('id')->on('inspection_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_inspections');
    }
};
