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
        Schema::create('agro_dealers', function (Blueprint $table) {
            $table->id();
            $table->string('agro_dealer_reg_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('physical_address');
            $table->string('district');
            $table->string('sub_county');
            $table->string('town_plot_number');
            $table->string('business_name');
            $table->string('dealers_in');
            $table->string('business_type');
            $table->string('business_registration_number');
            $table->unsignedInteger('years_in_operation');
            $table->text('business_description');
            $table->string('trading_license_info');
            $table->string('attachments_certificate');
            $table->string('proof_of_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agro_dealers');
    }
};
