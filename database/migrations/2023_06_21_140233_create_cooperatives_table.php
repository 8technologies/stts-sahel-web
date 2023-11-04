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
        Schema::create('cooperatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('cooperative_number');
            $table->string('seed_generation');
            $table->string('date_of_creation');
            $table->string('cooperative_name');
            $table->string('registration_number')->nullable();
            $table->string('cooperative_physical_address');
            $table->string('contact_person_name');
            $table->string('contact_phone_number');
            $table->string('contact_email')->nullable();
            $table->string('status')->nullable()->default('pending');
            $table->string('recommendation')->nullable();
            $table->text('status_comment')->nullable();
            $table->unsignedInteger('inspector_id')->nullable();
            $table->string('valid_from')->nullable();
            $table->string('valid_until')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('inspector_id')->references('id')->on('admin_users');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperatives');
    }
};
