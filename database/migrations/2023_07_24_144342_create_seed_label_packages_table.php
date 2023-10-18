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
        Schema::create('seed_label_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seed_label_id');
            $table->unsignedBigInteger('package_id');
            $table->integer('quantity')->nullable();
            $table->foreign('seed_label_id')->references('id')->on('seed_labels')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('label_packages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seed_label_packages');
    }
};
