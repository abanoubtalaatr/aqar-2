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
        Schema::table('complexes', function (Blueprint $table) {
            $table->integer('number_of_shops_from')->nullable();
            $table->integer('number_of_shops_to')->nullable();
            $table->integer('number_of_units_from')->nullable();
            $table->integer('number_of_units_to')->nullable();
            $table->integer('street_width')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complexes', function (Blueprint $table) {
            $table->dropColumn('number_of_shops_from');
            $table->dropColumn('number_of_shops_to');
            $table->dropColumn('number_of_units_from');
            $table->dropColumn('number_of_units_to');
            $table->integer('street_width')->nullable(false)->change();
        });
    }
};
