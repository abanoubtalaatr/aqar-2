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
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->integer('street_width')->nullable();

            $table->integer('number_of_rooms');
            $table->integer('number_of_living_rooms');
            $table->integer('number_of_bathrooms');

            $table->integer('floor_number');

            // additional
            $table->boolean('furnished')->default(false);
            $table->boolean('water_supply')->default(false);
            $table->boolean('air_conditioner')->default(false);
            $table->boolean('car_entrance')->default(false);
            $table->boolean('in_villa')->default(false);
            $table->boolean('sewerage_supply')->default(false);
            $table->boolean('electricity_supply')->default(false);
            $table->boolean('elevator')->default(false);
            $table->boolean('two_entrance')->default(false);
            $table->boolean('private_entrance')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floors');
    }
};
