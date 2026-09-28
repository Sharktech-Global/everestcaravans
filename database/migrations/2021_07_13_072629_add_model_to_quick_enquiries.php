<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModelToQuickEnquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quick_enquiries', function (Blueprint $table) {
            $table->string('vehicle_id');
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quick_enquiries', function (Blueprint $table) {
            $table->dropColumn('vehicle_id');
            $table->dropColumn('status');
        });
    }
}
