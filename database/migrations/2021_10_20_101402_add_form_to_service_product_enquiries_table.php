<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormToServiceProductEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_product_enquiries', function (Blueprint $table) {
            $table->string('form_name')->nullable()->after('location_id');
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
        Schema::table('service_product_enquiries', function (Blueprint $table) {
            //
        });
    }
}
