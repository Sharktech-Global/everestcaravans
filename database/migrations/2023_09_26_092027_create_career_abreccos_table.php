<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerAbreccosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_abreccos', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('name')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('career_type')->nullable();
            $table->string('message')->nullable();
            $table->string('query_type')->nullable();    
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
        Schema::dropIfExists('career_abreccos');
    }
}
