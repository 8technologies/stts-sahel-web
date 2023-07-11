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
        Schema::create('crop_seed_producers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crop_id');
            $table->unsignedBigInteger('seed_producer_id');
            $table->timestamps();
        
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');
            $table->foreign('seed_producer_id')->references('id')->on('seed_producers')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_seed_producer');
    }
};
