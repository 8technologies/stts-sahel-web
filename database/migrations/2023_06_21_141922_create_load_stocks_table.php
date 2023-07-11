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
        Schema::create('load_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('load_stock_number');
            $table->string('planting_return_number');
            $table->string('name_of_applicant');
            $table->string('registration_number');
            $table->string('seed_class');
            $table->unsignedFloat('field_size')->comment('In Acres');
            $table->unsignedFloat('yield_quantity');
            $table->date('last_field_inspection_date');
            $table->date('load_stock_date');
            $table->text('last_field_inspection_remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('load_stocks');
    }
};
