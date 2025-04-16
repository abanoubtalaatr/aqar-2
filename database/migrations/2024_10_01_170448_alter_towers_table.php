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
        Schema::table('towers', function (Blueprint $table) {
            $table->integer('floor_number_from')->nullable();
            $table->integer('floor_number_to')->nullable();
            $table->integer('number_of_elevators_from')->nullable();
            $table->integer('number_of_elevators_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('towers', function (Blueprint $table) {
            $table->dropColumn('floor_number_from');
            $table->dropColumn('floor_number_to');
            $table->dropColumn('number_of_elevators_from');
            $table->dropColumn('number_of_elevators_to');
        });
    }
};
