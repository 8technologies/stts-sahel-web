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
        Schema::create('cooperative_members', function (Blueprint $table) {

            $table->unsignedBigInteger('cooperative_id');
            $table->string('member_number');
            $table->string('farmer_first_name');
            $table->string('farmer_last_name');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->string('phone_number');
            $table->string('email_address')->nullable();
            $table->string('residential_physical_address')->nullable();
            $table->string('agriculture_value_chains');
            $table->timestamps();
            $table->foreign('cooperative_id')->references('id')->on('cooperatives')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperative_members');
    }
};
