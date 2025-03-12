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
        Schema::table('individual_producers', function (Blueprint $table) {
            $table->json('seed_generation')->change();
        });
        // cooperatives
        Schema::table('cooperatives', function (Blueprint $table) {
            $table->json('seed_generation')->change();
        });
        // seed_producers
        Schema::table('seed_producers', function (Blueprint $table) {
            $table->json('seed_generation')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('individual_producers', function (Blueprint $table) {
            $table->string('seed_generation')->change();
        });

        
        Schema::table('cooperatives', function (Blueprint $table) {
            $table->string('seed_generation')->change();
        });

        Schema::table('individual_producers', function (Blueprint $table) {
            $table->string('seed_generation')->change();
        });
    }
};
