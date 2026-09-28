<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropVarientFromExchanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exchanges', function (Blueprint $table) {
            $table->dropColumn('varient');
            $table->dropForeign('exchanges_condition_id_foreign');
            $table->dropColumn('condition_id');
            $table->dropColumn('color');
            $table->dropForeign('exchanges_emission_id_foreign');
            $table->dropColumn('emission_id');
            $table->dropColumn('kms_run');
            $table->dropColumn('insurance');
            $table->dropColumn('reg_number');
            $table->dropColumn('reg_year');
            $table->dropColumn('reg_month');
            $table->dropColumn('reg_city');
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
        Schema::table('exchanges', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->string('varient')->nullable();
            $table->string('condition_id');
            $table->foreign('condition_id')->references('id')->on('conditions')->onDelete('cascade');
            $table->string('color');
            $table->string('emission_id');
            $table->foreign('emission_id')->references('id')->on('emissions')->onDelete('cascade');
            $table->string('kms_run')->nullable();
            $table->string('insurance')->nullable();
            $table->string('reg_number')->nullable();
            $table->string('reg_year')->nullable();
            $table->string('reg_month')->nullable();
            $table->string('reg_city')->nullable();
            $table->string('email');
            $table->string('time_of_contact')->nullable();
            Schema::enableForeignKeyConstraints();
        });
    }
}
