<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_editions', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('vehicle_id');
            $table->string('banner_image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('brochure')->nullable();
            $table->boolean('is_booking')->default(1);
            $table->string('booking_amount')->nullable();
            $table->boolean('status')->default(1);
            $table->biginteger('order')->nullable();
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
        Schema::dropIfExists('vehicle_editions');
    }
}
