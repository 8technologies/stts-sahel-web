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
            $table->text('previous_seed_culture')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('field_inspections', function (Blueprint $table) {
            $table->bigInteger('previous_seed_culture')->change();
        });
    }
};
