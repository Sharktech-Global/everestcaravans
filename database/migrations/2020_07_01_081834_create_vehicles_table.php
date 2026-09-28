<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('name');
            $table->string('slug');
            $table->text('title')->nullable();
            $table->text('tagline')->nullable();
            $table->string('thumb')->nullable();
            $table->string('image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('brochure')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_booking')->default(1);
            $table->string('booking_amount')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
