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
            $table->unsignedBigInteger('user_id');
            $table->string('agro_dealer_reg_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('district')->nullable();
            $table->string('circle')->nullable();
            $table->string('township')->nullable();
            $table->string('town_plot_number')->nullable();
            $table->string('shop_number')->nullable();
            $table->string('company_name')->nullable();
            $table->string('retailers_in')->nullable();
            $table->string('business_registration_number')->nullable();
            $table->integer('years_in_operation')->nullable();
            $table->text('business_description')->nullable();
            $table->string('trading_license_number')->nullable();
            $table->string('trading_license_period')->nullable();
            $table->string('insuring_authority')->nullable();
            $table->string('attachments_certificate')->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->string('cancellation_clauses')->nullable();
            $table->string('confidentiality_obligations')->nullable();
            $table->string('non_disclosure_agreement')->nullable();
            $table->string('status')->default('pending');
            $table->string('status_comment')->nullable();
            $table->string('valid_from')->nullable();
            $table->string('valid_until')->nullable();
            $table->unsignedBigInteger('inspector_id')->nullable();

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
