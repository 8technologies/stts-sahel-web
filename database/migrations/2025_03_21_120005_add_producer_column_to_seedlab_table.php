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
            $table->integer('variegated_purity_test')->nullable()->after('purity_test_results');
            $table->string('lab_seed_generation')->nullable()->after('seed_generation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seed_labs', function (Blueprint $table) {
            $table->dropColumn('variegated_purity_test');
            $table->dropColumn('lab_seed_generation');
        });
    }
};
