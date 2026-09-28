<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraToNetworkBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('network_branches', function (Blueprint $table) {
            $table->string('head_mobile')->nullable()->after('branch_head');
            $table->string('head_email')->nullable()->after('head_mobile');
            $table->string('address_mobile')->nullable()->after('branch_address');
            $table->string('address_email')->nullable()->after('address_mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('network_branches', function (Blueprint $table) {
            //
        });
    }
}
