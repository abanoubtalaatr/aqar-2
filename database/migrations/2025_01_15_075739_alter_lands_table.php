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
        Schema::table('lands', function (Blueprint $table) {
            $table->renameColumn('price_meter_from', 'meter_price_from');
            $table->renameColumn('price_meter_to', 'meter_price_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lands', function (Blueprint $table) {
            //
        });
    }
};
