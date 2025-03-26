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
            $table->string("crop_declaration_period")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crop_declarations', function (Blueprint $table) {
            $table->dropColumn('crop_declaration_period');
        });
    }
};
