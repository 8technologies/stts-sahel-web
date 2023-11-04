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
        Schema::create('out_growers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seed_company_id');
            $table->string('contract_number')->unique();
            $table->string('seed_company_registration_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number')->unique();
            $table->string('gender')->nullable();
            $table->string('email_address')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('town_street')->nullable();
            $table->string('plot_number')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
       

            $table->foreign('seed_company_id')->references('id')->on('seed_producers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('out_growers');
    }
};
