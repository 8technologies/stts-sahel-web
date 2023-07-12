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
            $table->string('load_stock_number')->nullable();
            $table->unsignedBigInteger('crop_declarattion_id')->nullable();
            $table->string('name_of_applicant')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('seed_class')->nullable();
            $table->unsignedFloat('field_size')->comment('In Acres')->nullable();
            $table->unsignedFloat('yield_quantity')->nullable();
            $table->date('last_field_inspection_date')->nullable();
            $table->date('load_stock_date')->nullable();
            $table->text('last_field_inspection_remarks')->nullable();
            $table->timestamps();

            $table->foreign('crop_declarattion_id')->references('id')->on('crop_declarations')->onDelete('cascade');
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
