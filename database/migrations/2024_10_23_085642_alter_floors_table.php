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
        Schema::table('floors', function (Blueprint $table) {
            $table->string('number_of_rooms')->nullable()->change();
            $table->string('number_of_living_rooms')->nullable()->change();
            $table->string('number_of_bathrooms')->nullable()->change();
            $table->string('floor_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('floors', function (Blueprint $table) {
            $table->integer('number_of_rooms')->nullable()->change();
            $table->integer('number_of_living_rooms')->nullable()->change();
            $table->integer('number_of_bathrooms')->nullable()->change();
            $table->integer('floor_number')->nullable()->change();
        });
    }
};
