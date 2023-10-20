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
            $table->unsignedInteger('user_id');
            $table->string('registration_number')->nullable();
            $table->unsignedBigInteger('seed_lab_id');
            $table->string('label_packages');
            $table->unsignedFloat('quantity_of_seed')->nullable();
            $table->string('proof_of_payment');
            $table->date('request_date');
            $table->text('applicant_remarks')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('seed_lab_id')->references('id')->on('seed_labs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
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
