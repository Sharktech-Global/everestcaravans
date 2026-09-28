<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormToCareerEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career_enquiries', function (Blueprint $table) {
            $table->string('form_name')->nullable()->after('cv');
            $table->string('page_name')->nullable()->after('form_name');
            $table->string('refer')->nullable()->after('page_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('career_enquiries', function (Blueprint $table) {
            //
        });
    }
}
