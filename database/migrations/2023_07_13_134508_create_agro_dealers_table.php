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
            $table->string('circle');
            $table->string('township');
            $table->string('town_plot_number');
            $table->string('shop_number');
            $table->string('company_name');
            $table->string('retailers_in');
            $table->string('business_registration_number');
            $table->integer('years_in_operation');
            $table->text('business_description');
            $table->string('trading_license_number');
            $table->string('trading_license_period');
            $table->string('insuring_authority');
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
