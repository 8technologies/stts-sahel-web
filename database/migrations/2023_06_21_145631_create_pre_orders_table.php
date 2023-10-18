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
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedBigInteger('crop_variety_id');
            $table->string('seed_class');
            $table->float('quantity');
            $table->date('preferred_delivery_date')->nullable();
            $table->date('order_date');
            $table->string('client_name')->nullable();
            $table->string('client_physical_address')->nullable();
            $table->string('client_contact_number')->nullable();
            $table->string('client_email_address')->nullable();
            $table->string('preferred_payment_method')->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->string('seed_delivery_preferences')->nullable();
            $table->text('other_information')->nullable();
            $table->timestamps();

            $table->foreign('crop_variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_orders');
    }
};
