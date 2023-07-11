<?php

use App\Models\Crop;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_varieties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crop_id');
            $table->text("crop_variety_name");
            $table->string("crop_variety_code");
            $table->string("crop_variety_generation");

            $table->timestamps();
        
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crop_varieties');
    }
}

