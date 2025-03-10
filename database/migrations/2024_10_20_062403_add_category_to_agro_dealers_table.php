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
            $table->string('category')->nullable()->comment('Retailers or Wholesalers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agro_dealers', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
