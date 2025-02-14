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
            $table->string('isolation')->nullable();
            $table->string('isolation_time')->nullable();
            $table->integer('isolation_distance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('field_inspections', function (Blueprint $table) {
            $table->dropColumn('isolation');
            $table->dropColumn('isolation_time');
            $table->dropColumn('isolation_distance');
        });
    }
};
