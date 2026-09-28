<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_groups', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('banner_image')->nullable();
            $table->longText('content');
            $table->string('content_image_one');
            $table->string('content_image_two')->nullable();
            $table->string('content_image_three')->nullable();
            $table->string('seo_title')->nullable()->nullable();
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
        Schema::dropIfExists('about_groups');
    }
}
