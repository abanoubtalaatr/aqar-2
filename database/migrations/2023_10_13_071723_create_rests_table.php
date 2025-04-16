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
        Schema::create('rests', function (Blueprint $table) {
            $table->id();
            // $table->enum('Interface', [
            //     'north', 'south', 'east', 'west',
            //     'south_east', 'south_west', 'north_east', 'north_west', '3_streets', '4_streets'
            // ]);
            $table->enum('Interface', [
                '0', '1', '2', '3',
                '4', '5', '6', '7', '8', '9',
            ]);
            $table->integer('number_of_rooms');
            $table->integer('number_of_living_rooms');
            $table->integer('number_of_bathrooms');

            // $table->enum('families_or_singles', ['families', 'singles', 'both']);
            $table->enum('families_or_singles', ['0', '1', '2']);
            $table->integer('street_width')->nullable();

            // additional

            $table->boolean('sewerage_supply')->default(false);
            $table->boolean('electricity_supply')->default(false);
            $table->boolean('water_supply')->default(false);
            $table->boolean('pool')->default(false);
            $table->boolean('football_field')->default(false);
            $table->boolean('volleyball_field')->default(false);
            $table->boolean('verse')->default(false);
            $table->boolean('amusement_park_games')->default(false);
            $table->boolean('family_area')->default(false);
            $table->boolean('car_entrance')->default(false);
            $table->boolean('kitchen')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rests');
    }
};
