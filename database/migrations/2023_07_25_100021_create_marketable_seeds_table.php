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
        Schema::create('marketable_seeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('seed_lab_id');
            $table->unsignedBigInteger('load_stock_id');
            $table->unsignedBigInteger('crop_variety_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('seed_lab_id')->references('id')->on('seed_labs')->onDelete('cascade');
            $table->foreign('load_stock_id')->references('id')->on('load_stocks')->onDelete('cascade');
            $table->foreign('crop_variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketable_seeds');
    }
};
