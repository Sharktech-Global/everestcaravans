<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropVehicleIdFromLocateUsEnquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locate_us_enquiries', function (Blueprint $table) {
            $table->dropForeign('locate_us_enquiries_vehicle_id_foreign');
            $table->dropColumn('vehicle_id');
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
            Schema::disableForeignKeyConstraints();
            $table->string('vehicle_id')->nullable()->after('phone');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
        });
    }
}
