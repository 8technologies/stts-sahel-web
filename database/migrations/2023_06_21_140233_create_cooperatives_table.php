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
            $table->string('cooperative_number');
            $table->string('cooperative_name');
            $table->string('registration_number')->nullable();
            $table->string('cooperative_physical_address');
            $table->string('contact_person_name');
            $table->string('contact_phone_number');
            $table->string('contact_email')->nullable();
            $table->string('membership_type');
            $table->string('services_to_members');
            $table->string('objectives_or_goals');
            $table->timestamps();
        
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
