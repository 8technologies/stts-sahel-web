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
        Schema::create('role_seed_class', function (Blueprint $table) {
            $table->unsignedInteger('role_id'); // Foreign key to roles table
            $table->unsignedBigInteger('seed_class_id'); // Foreign key to seed_generations table
            
            // Foreign key constraints
            $table->foreign('role_id')->references('id')->on('admin_roles');
            $table->foreign('seed_class_id')->references('id')->on('seed_classes');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_seed_class');
    }
};
