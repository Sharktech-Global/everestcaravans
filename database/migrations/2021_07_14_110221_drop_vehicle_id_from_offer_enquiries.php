<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropVehicleIdFromOfferEnquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_enquiries', function (Blueprint $table) {
            $table->dropForeign('offer_enquiries_vehicle_id_foreign');
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
        Schema::table('offer_enquiries', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->string('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
        });
    }
}
