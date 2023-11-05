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
            $table->unsignedInteger('user_id')->nullable();
            $table->string('load_stock_number')->nullable();
            $table->unsignedBigInteger('crop_declaration_id')->nullable();
            $table->unsignedBigInteger('crop_variety_id')->nullable();
            $table->string('name_of_applicant')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('seed_class')->nullable();
            $table->unsignedFloat('field_size')->comment('In Acres')->nullable();
            $table->unsignedFloat('yield_quantity')->nullable();
            $table->date('last_field_inspection_date')->nullable();
            $table->date('load_stock_date')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('crop_declaration_id')->references('id')->on('crop_declarations')->onDelete('cascade');
            $table->foreign('crop_variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
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
