<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropEmailFromTestDriveEnquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_drive_enquiries', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('time_of_contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_drive_enquiries', function (Blueprint $table) {
            $table->string('email');
            $table->string('time_of_contact');
        });
    }
}
