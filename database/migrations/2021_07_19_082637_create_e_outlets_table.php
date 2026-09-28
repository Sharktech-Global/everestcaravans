<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_outlets', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('dealership_id');
            $table->string('spc_name');
            $table->string('spc_head');
            $table->string('spc_head_phone');
            $table->string('spc_head_email');
            $table->text('address');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->foreign('dealership_id')->references('id')->on('dealerships')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e_outlets');
    }
}
