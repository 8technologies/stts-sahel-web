<?php
use OpenAdmin\Admin\Auth\Database\Administrator;
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
        Schema::create('seed_producers', function (Blueprint $table) {
            $table->id();
            $table->foreignId(Administrator::class);
            $table->string('producer_registration_number')->nullable();
            $table->string('producer_category');
            $table->string('name_of_applicant');
            $table->string('applicant_phone_number');
            $table->string('applicant_email');
            $table->string('premises_location');
            $table->string('proposed_farm_location');
            $table->string('years_of_experience');
            $table->text('gardening_history_description');
            $table->text('storage_facilities_description');
            $table->tinyInteger('have_adequate_isolation');
            $table->text('labor_details');
            $table->string('receipt');
            $table->string('status')->default('pending');
            $table->text('status_comment')->nullable();
            $table->string('inspector')->nullable();
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_until')->nullable();
   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seed_producers');
    }
};
