<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropModelFromInsuranceEnquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_enquiries', function (Blueprint $table) {
            $table->dropColumn('model');
            $table->dropColumn('manufacture_year');
            $table->dropColumn('ownership_type');
            $table->dropColumn('vehicle_requirement');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropForeign('insurance_enquiries_country_id_foreign');
            $table->dropColumn('country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_enquiries', function (Blueprint $table) {
            $table->string('model');
            $table->string('manufacture_year');
            $table->string('ownership_type');
            $table->string('vehicle_requirement');
            $table->string('phone');
            $table->text('address');
            Schema::disableForeignKeyConstraints();
            $table->string('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
            $table->string('country_id');
        });
    }
}
