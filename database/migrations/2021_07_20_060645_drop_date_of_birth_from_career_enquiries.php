<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDateOfBirthFromCareerEnquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career_enquiries', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
            $table->dropForeign('career_enquiries_country_id_foreign');
            $table->dropColumn('country_id');
            $table->dropColumn('marital_status');
            $table->dropColumn('permanent_address');
            $table->dropColumn('experience');
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
            $table->date('date_of_birth')->nullable()->after('phone');
            Schema::disableForeignKeyConstraints();
            $table->string('country_id')->nullable()->after('date_of_birth');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
            $table->string('marital_status')->nullable()->after('country_id');
            $table->text('permanent_address')->nullable()->after('marital_status');
            $table->text('experience')->nullable()->after('permanent_address');
        });
    }
}
