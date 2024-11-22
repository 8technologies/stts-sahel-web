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
        Schema::table('crop_declarations', function (Blueprint $table) {
            $table->unsignedBigInteger('previous_seed_culture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crop_declarations', function (Blueprint $table) {
            $table->dropColumn('previous_seed_culture');
        });
    }
};
