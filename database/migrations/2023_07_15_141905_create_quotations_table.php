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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preorder_id');
            $table->string('quantity');
            $table->string('price');
            $table->string('supply_date');
            $table->unsignedInteger('quotation_by');
            $table->unsignedInteger('quotation_to');
            $table->string('details');
            $table->string('status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('status_comment')->nullable();
            $table->timestamps();

            $table->foreign('preorder_id')->references('id')->on('pre_orders')->onDelete('cascade');
            $table->foreign('quotation_by')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('quotation_to')->references('id')->on('admin_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
