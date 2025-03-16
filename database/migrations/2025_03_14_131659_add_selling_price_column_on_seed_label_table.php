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
        Schema::table('seed_labels', function (Blueprint $table) {
            $table->string('selling_price')->nullable();
            $table->string('unit_price')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seed_labels', function (Blueprint $table) {
            $table->dropColumn('selling_price');
            $table->dropColumn('unit_price');
            
        });
    }
};
