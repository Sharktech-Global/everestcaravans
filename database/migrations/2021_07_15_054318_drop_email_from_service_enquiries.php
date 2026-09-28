<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropEmailFromServiceEnquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_enquiries', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropForeign('service_enquiries_service_type_id_foreign');
            $table->dropColumn('service_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_enquiries', function (Blueprint $table) {
            $table->string('email');
            Schema::disableForeignKeyConstraints();
            $table->string('service_type_id');
            $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
        });
    }
}
