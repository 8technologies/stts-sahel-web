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
        Schema::create('crop_variety_inspection_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crop_variety_id');
            $table->unsignedBigInteger('inspection_type_id');
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
        Schema::dropIfExists('crop_variety_inspection_type_');
    }
};
