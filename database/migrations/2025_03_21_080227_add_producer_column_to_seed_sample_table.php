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
        Schema::table('seed_labs', function (Blueprint $table) {
            $table->integer('number_of_samples')->nullable();
            $table->string('year_of_production')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seed_labs', function (Blueprint $table) {
            $table->dropColumn('number_of_samples');
            $table->dropColumn('year_of_production');
        });
    }
};
