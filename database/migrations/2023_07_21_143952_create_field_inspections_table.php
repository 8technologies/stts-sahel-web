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
            $table->string('field_inspection_form_number')->nullable();
            $table->unsignedBigInteger('crop_declaration_id')->nullable();
            $table->unsignedBigInteger('crop_variety_id')->nullable();
            $table->unsignedBigInteger('inspection_type_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('physical_address')->nullable();
            $table->unsignedFloat('field_size')->nullable();
            $table->string('seed_generation')->nullable();
            $table->string('crop_condition')->nullable();
            $table->string('plant_density')->nullable();
            $table->string('seed_category')->nullable();
            $table->string('planting_ratio')->nullable();
            $table->unsignedFloat('estimated_yield')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedInteger('inspector_id')->nullable();
            $table->string('signature')->nullable();
            $table->string('status')->nullable();
            $table->integer('is_active');
            $table->integer('is_done');
            $table->integer('order_number')->nullable();
            $table->date('inspection_date')->nullable();
            $table->timestamps();

            $table->foreign('crop_variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');
            $table->foreign('inspection_type_id')->references('id')->on('inspection_types')->onDelete('cascade');
            $table->foreign('crop_declaration_id')->references('id')->on('crop_declarations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('inspector_id')->references('id')->on('admin_users');
            
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
