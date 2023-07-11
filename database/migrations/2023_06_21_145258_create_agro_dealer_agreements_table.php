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
        Schema::create('agro_dealer_agreements', function (Blueprint $table) {
            $table->id();
            $table->string('agro_dealer_agreement_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_name')->nullable();
            $table->string('legal_business_name')->nullable();
            $table->string('contact_person');
            $table->string('contact_phone_number');
            $table->string('email_address');
            $table->string('physical_address');
            $table->date('agreement_effective_date');
            $table->date('date_of_agreement');
            $table->string('signed_by');
            $table->integer('agreement_term_or_duration');
            $table->text('termination_clauses_and_conditions');
            $table->text('confidentiality_obligations');
            $table->text('non_disclosure_agreements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agro_dealer_agreements');
    }
};
