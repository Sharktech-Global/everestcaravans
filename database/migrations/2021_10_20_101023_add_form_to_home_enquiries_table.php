<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormToHomeEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_enquiries', function (Blueprint $table) {
            $table->string('form_name')->nullable()->after('location');
            $table->string('page_name')->nullable()->after('form_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_enquiries', function (Blueprint $table) {
            //
        });
    }
}
