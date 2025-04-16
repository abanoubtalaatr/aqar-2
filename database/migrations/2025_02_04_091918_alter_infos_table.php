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
        Schema::table('infos', function (Blueprint $table) {
            $table->string('bank_name_ar')->default('بنك الحراجي');
            $table->string('bank_name_en')->default('Bank Al-Harajy');
            $table->string('bank_image')->default('public/storage/infos/1700380761Website logo.png');
            $table->string('bank_account')->default('487000010006086221519');
            $table->string('iban')->default('SA1780000487608016221519');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('infos', function (Blueprint $table) {
            //
        });
    }
};
