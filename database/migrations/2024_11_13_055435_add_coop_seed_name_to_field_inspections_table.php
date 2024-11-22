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
        Schema::table('field_inspections', function (Blueprint $table) {
            $table->text('coop_seed_name')->nullable()->after('seed_generation');
            $table->text('planting_date')->nullable()->after('coop_seed_name');
            $table->text('origin_of_variety')->nullable()->after('planting_date');
            $table->unsignedBigInteger('previous_seed_culture')->nullable()->after('origin_of_variety');        
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('field_inspections', function (Blueprint $table) {
            $table->dropColumn('coop_seed_name');
            $table->dropColumn('planting_date')->nullable();
            $table->dropColumn('origin_of_variety')->nullable();
            $table->dropColumn('previous_seed_cultures')->nullable();        
    
        });
    }
};
