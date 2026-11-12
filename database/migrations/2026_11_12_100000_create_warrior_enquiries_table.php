<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warrior_enquiries', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('phone', 30);
            $table->string('postcode', 10);

            // 19.5 / 21.5 / both — the landing page offers nothing else
            $table->string('preferred_model', 20);
            $table->string('purchase_timeframe', 40);
            $table->string('enquiry_type', 40);

            // Landing page leads are judged by campaign, so keep the referrer
            $table->string('source_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warrior_enquiries');
    }
};
