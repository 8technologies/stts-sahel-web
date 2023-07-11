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
        Schema::create('out_grower_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number');
            $table->string('seed_company_name');
            $table->string('seed_company_registration_number')->nullable();
            $table->string('out_grower_first_name');
            $table->string('out_grower_last_name');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('email')->nullable();
            $table->string('district');
            $table->string('sub_county')->nullable();
            $table->string('town');
            $table->integer('plot_number');
            $table->text('contract_details');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('out_grower_signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('out_grower_contracts');
    }
};
