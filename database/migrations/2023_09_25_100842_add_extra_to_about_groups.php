<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraToAboutGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_groups', function (Blueprint $table) {
            $table->longText('sub_content')->nullable()->after('sub_title');
            $table->longText('location_title')->nullable()->after('sub_content');
            $table->longText('location_content')->nullable()->after('location_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_groups', function (Blueprint $table) {
            //
        });
    }
}
