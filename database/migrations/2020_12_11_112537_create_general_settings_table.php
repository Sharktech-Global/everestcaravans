<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('mobile');
            $table->string('whatsapp')->nullable();
            $table->string('logo');
            $table->string('logo_secondary')->nullable();
            $table->string('favicon');
            $table->string('facebook');
            $table->string('map');
            $table->integer('popup')->default(1);
            $table->string('website_color')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
