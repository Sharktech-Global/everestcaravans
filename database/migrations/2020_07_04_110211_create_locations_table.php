<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('location_type_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->text('email_ccs')->nullable();
            $table->text('email_bccs')->nullable();
            $table->text('phone_numbers')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('location_type_id')->references('id')->on('location_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
