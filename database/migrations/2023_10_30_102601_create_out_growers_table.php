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
            $table->string('contract_number');
            $table->string('seed_company_name');
            $table->string('seed_company_registration_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('email_address');
            $table->string('district');
            $table->string('sub_county');
            $table->string('town_street');
            $table->string('plot_number');
            $table->date('valid_from');
            $table->date('valid_to');
            $table->string('signature');

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
