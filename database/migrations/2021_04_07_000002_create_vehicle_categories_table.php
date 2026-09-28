<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_categories', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('vehicle_id');
            $table->string('vehicle_variant_id');
            $table->string('category_type_id');
            $table->string('category_id');
            $table->string('sub_category_id');
            $table->smallInteger('check_similar')->nullable();
            $table->longText('details')->nullable();
            $table->smallInteger('is_boolean')->nullable();
            $table->smallInteger('status')->nullable();

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
        Schema::dropIfExists('vehicle_categories');
    }
}
