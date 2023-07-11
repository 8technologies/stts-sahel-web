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
        Schema::create('seed_labels', function (Blueprint $table) {
            $table->id();
            $table->string('seed_label_request_number');
            $table->string('applicant_name');
            $table->string('registration_number');
            $table->string('seed_lab_id');
            $table->string('label_packages');
            $table->unsignedFloat('quantity_of_seed');
            $table->string('proof_of_payment');
            $table->date('request_date');
            $table->text('applicant_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seed_labels');
    }
};
