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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('receiver_id')->nullable(); 
            $table->bigInteger('role_id')->nullable(); 
            $table->text('message')->nullable();
            $table->text('form_link')->nullable();
            $table->text('link')->nullable();
            $table->string('status')->nullable(); 
            $table->string('model')->nullable(); 
            $table->string('model_id')->nullable(); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
