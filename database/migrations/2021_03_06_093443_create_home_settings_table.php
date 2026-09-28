<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_settings', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('testdrive_image');
            $table->string('testdrive_text');
            $table->string('insurance_image');
            $table->string('insurance_text');
            $table->string('exchange_image');
            $table->string('exchange_text');
            $table->string('service_image');
            $table->string('service_text');
            $table->string('contact_image');
            $table->string('background_image');
            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
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
        Schema::dropIfExists('home_settings');
    }
}
