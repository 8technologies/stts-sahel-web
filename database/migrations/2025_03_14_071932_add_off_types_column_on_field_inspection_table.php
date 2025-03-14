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
            $table->boolean('off_types')->default(1);
            $table->text('level')->nullable();
            $table->integer('number_of_offtypes');
            $table->string('health_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('field_inspections', function (Blueprint $table) {
            $table->dropColumn('off_types');
            $table->dropColumn('level');
            $table->dropColumn('number_of_offtypes');
            $table->dropColumn('health_status');
        });
    }
};
