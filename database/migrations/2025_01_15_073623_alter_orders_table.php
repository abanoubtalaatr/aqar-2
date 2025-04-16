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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('street_width_from')->change();
            $table->string('street_width_to')->change();
            $table->string('property_age_from')->change();
            $table->string('property_age_to')->change();
            $table->string('area_from')->change();
            $table->string('area_to')->change();
            $table->string('meter_price')->change();
            $table->string('price_from')->change();
            $table->string('price_to')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
