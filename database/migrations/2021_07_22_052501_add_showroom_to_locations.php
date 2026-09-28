<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowroomToLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('showroom')->nullable()->after('email');
            $table->text('content')->nullable()->after('showroom');
            $table->string('banner_image')->nullable()->after('content');
            $table->text('address')->nullable()->after('banner_image');
            $table->string('slug')->nullable()->after('address');
            $table->text('map')->nullable()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('showroom');
            $table->dropColumn('content');
            $table->dropColumn('banner_image');
            $table->dropColumn('address');
            $table->dropColumn('slug');
            $table->dropColumn('map');
        });
    }
}
