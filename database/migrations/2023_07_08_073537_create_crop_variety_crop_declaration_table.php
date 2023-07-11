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
        Schema::create('crop_variety_crop_declaration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crop_variety_id');
            $table->unsignedBigInteger('crop_declaration_id');
            $table->timestamps();
        
            $table->foreign('crop_variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');
            $table->foreign('crop_declaration_id')->references('id')->on('crop_declarations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_variety_crop_declaration');
    }
};
