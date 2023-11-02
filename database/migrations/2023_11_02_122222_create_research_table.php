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
        Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('researcher_registration_number');
            $table->string('researcher_category');
            $table->string('name_of_applicant');
            $table->string('applicant_phone_number');
            $table->string('applicant_email');
            $table->string('premises_location');
            $table->string('proposed_farm_location');
            $table->string('years_of_experience');
            $table->string('gardening_history_description');
            $table->string('storage_facilities_description');
            $table->string('have_adequate_isolation');
            $table->string('labor_details');
            $table->string('receipt');
            $table->string('status');
            $table->string('status_comment');
            $table->string('inspector_id');
            $table->string('grower_number');
            $table->string('valid_from');
            $table->string('valid_until');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};
