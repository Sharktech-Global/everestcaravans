<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationIdToLocateUsEnquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locate_us_enquiries', function (Blueprint $table) {
            $table->string('location_id')->nullable()->after('phone');
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
        Schema::table('locate_us_enquiries', function (Blueprint $table) {
            $table->dropForeign('location_id');
            $table->dropColumn('location_id');
        });
    }
}
