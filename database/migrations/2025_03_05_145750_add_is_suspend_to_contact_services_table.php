<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contact_services', function (Blueprint $table) {
            $table->boolean('is_active')->default(0)->comment('Suspend this use can not send email the email again to the service provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_services', function (Blueprint $table) {
            //
        });
    }
};
