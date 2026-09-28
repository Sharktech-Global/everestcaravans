<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetworkBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_branches', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('main_id');
            $table->string('sub_id');
            $table->string('branch_name');
            $table->string('branch_head')->nullable();
            $table->string('branch_address')->nullable();
            $table->string('location')->nullable();
            $table->string('website_link')->nullable();
            $table->string('wm_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_branches');
    }
}
