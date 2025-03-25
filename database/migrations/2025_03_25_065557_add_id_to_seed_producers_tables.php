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
        Schema::table('agro_dealers', function (Blueprint $table) {
            $table->string('national_id')->nullable()->after('id');
        });
        Schema::table('cooperatives', function (Blueprint $table) {
            $table->string('national_id')->nullable()->after('id');
        });
        Schema::table('individual_producers', function (Blueprint $table) {
            $table->string('national_id')->nullable()->after('id');
        });
        Schema::table('research', function (Blueprint $table) {
            $table->string('national_id')->nullable()->after('id');
        });
        Schema::table('seed_producers', function (Blueprint $table) {
            $table->string('national_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agro_dealers', function (Blueprint $table) {
            $table->dropColumn('national_id');
        });
        Schema::table('cooperatives', function (Blueprint $table) {
            $table->dropColumn('national_id');
        });
        Schema::table('individual_producers', function (Blueprint $table) {
            $table->dropColumn('national_id');
        });
        Schema::table('research', function (Blueprint $table) {
            $table->dropColumn('national_id');
        });
        Schema::table('seed_producers', function (Blueprint $table) {
            $table->dropColumn('national_id');
        });
    }
};
