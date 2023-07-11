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
        Schema::create('seed_lab_test_reports', function (Blueprint $table) {
            $table->id();
            $table->string('seed_lab_test_report_number');
            $table->string('seed_sample_request_number');
            $table->string('planting_return_id');
            $table->string('applicant_name');
            $table->unsignedFloat('seed_sample_size');
            $table->string('testing_methods');
            $table->unsignedFloat('germination_test_results');
            $table->unsignedFloat('purity_test_results');
            $table->unsignedFloat('moisture_content_test_results');
            $table->text('additional_tests_results')->nullable();
            $table->string('test_decision');
            $table->text('reporting_and_signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seed_lab_test_reports');
    }
};
