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
        Schema::create('certification_forms', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_name')->nullable();
            $table->string('applicants_registration_number');
            $table->string('applicants_contact');
            $table->string('category');
            $table->string('certification_type');
            $table->date('validity_period');
            $table->text('application_details');
            $table->text('assessment_evaluation');
            $table->text('supporting_documents');
            $table->boolean('declaration_agreement');
            $table->string('signature');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certification_forms');
    }
};
