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
        Schema::create('seed_production_contract_forms', function (Blueprint $table) {
            $table->id();
            $table->string('production_contract_number')->nullable();
            $table->unsignedBigInteger('crop_id')->nullable();
            $table->unsignedBigInteger('variety_id')->nullable();
            $table->unsignedBigInteger('seed_company_id')->nullable();
            $table->string('producer_first_name')->nullable();
            $table->string('producer_last_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('email_address')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('contract_details')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('signature_of_operator')->nullable();
            $table->timestamps();

            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');
            $table->foreign('variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');
            $table->foreign('seed_company_id')->references('id')->on('seed_companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seed_producer_contract_forms');
    }
};
