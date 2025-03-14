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
            $table->bigInteger('seed_generation');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seed_labs', function (Blueprint $table) {
            $table->dropColumn('seed_generation');
            
        });
    }
};
