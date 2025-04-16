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
            $table->float('commission_for_order_rent')->default(.04);
            $table->float('commission_for_order_sell')->default(1);
            $table->float('commission_for_ad_gold_rent')->default(.70);
            $table->float('commission_for_ad_gold_sell')->default(1.50);
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
