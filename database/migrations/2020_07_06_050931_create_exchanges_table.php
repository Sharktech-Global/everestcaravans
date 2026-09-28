<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('model');
            $table->string('varient')->nullable();
            $table->string('condition_id');
            $table->string('color');
            $table->string('emission_id');
            $table->string('kms_run')->nullable();
            $table->string('insurance')->nullable();
            $table->string('reg_number')->nullable();
            $table->string('reg_year')->nullable();
            $table->string('reg_month')->nullable();
            $table->string('reg_city')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('location_id');
            $table->string('time_of_contact')->nullable();
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('condition_id')->references('id')->on('conditions')->onDelete('cascade');
            $table->foreign('emission_id')->references('id')->on('emissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
