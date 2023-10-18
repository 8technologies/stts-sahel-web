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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preorder_id')->nullable();
            $table->unsignedBigInteger('quotation_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('supply_date')->nullable();
            $table->unsignedInteger('order_by')->nullable();
            $table->unsignedInteger('supplier')->nullable();
            $table->string('details')->nullable();
            $table->string('status')->nullable();
            $table->string('status_comment')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('order_number')->nullable();
            $table->date('order_date')->nullable();

            $table->foreign('preorder_id')->references('id')->on('pre_orders')->onDelete('cascade');
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreign('order_by')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('supplier')->references('id')->on('admin_users')->onDelete('cascade');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
