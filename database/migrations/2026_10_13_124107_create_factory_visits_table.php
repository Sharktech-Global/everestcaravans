<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factory_visits', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('phone', 30);

            $table->date('visit_date');
            $table->string('visit_time', 50);

            $table->string('suburb')->nullable();
            $table->string('state', 10)->nullable();
            $table->string('postcode', 10)->nullable();

            $table->string('vehicle_name')->nullable();
            $table->text('additional_requirements')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factory_visits');
    }
};