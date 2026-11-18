
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('warrior_enquiries', function (Blueprint $table) {
            $table->string('next_action')->nullable();
            $table->string('location')->nullable();
            $table->string('whatsapp_number', 30)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('warrior_enquiries', function (Blueprint $table) {
            $table->dropColumn([
                'next_action',
                'location',
                'whatsapp_number',
            ]);
        });
    }
};
