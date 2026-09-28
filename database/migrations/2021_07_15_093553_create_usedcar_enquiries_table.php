<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsedcarEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usedcar_enquiries', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('model');
            $table->string('name');
            $table->string('phone');
            $table->string('year');
            $table->string('location_id');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usedcar_enquiries');
    }
}
