<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_sliders', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('type');
            $table->string('name');
            $table->string('logo');
            $table->text('description');
            $table->string('image');
            $table->string('thumb1');
            $table->string('thumb2');
            $table->string('vehicle_id')->nullable();
            $table->string('booking')->nullable();
            $table->string('explore')->nullable();
            $table->smallInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_sliders');
    }
}
