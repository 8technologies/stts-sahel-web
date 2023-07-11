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
        Schema::create('seed_sampling_requests', function (Blueprint $table) {
            $table->id();
            $table->string('sample_request_number');
            $table->string('applicant_id');
            $table->string('load_stock_number');
            $table->date('sample_request_date');
            $table->string('proof_of_payment')->nullable();
            $table->text('applicant_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seed_sampling_requests');
    }
};
