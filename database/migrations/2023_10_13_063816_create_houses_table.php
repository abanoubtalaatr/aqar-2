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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();

            // $table->enum('Interface', [
            //     'north', 'south', 'east', 'west',
            //     'south_east', 'south_west', 'north_east', 'north_west', '3_streets', '4_streets'
            // ]);
            $table->enum('Interface', [
                '0', '1', '2', '3',
                '4', '5', '6', '7', '8', '9',
            ]);
            $table->integer('street_width')->nullable();
            $table->integer('number_of_rooms');
            $table->integer('number_of_living_rooms');
            $table->integer('number_of_bathrooms');

            $table->enum('renting_duration', ['0', '1', '2'])->nullable();

            // additional
            $table->boolean('kitchen')->default(false);
            $table->boolean('furnished')->default(false);
            $table->boolean('driver_room')->default(false);
            $table->boolean('maid_room')->default(false);
            $table->boolean('verse')->default(false);
            $table->boolean('attachment')->default(false);
            $table->boolean('car_entrance')->default(false);
            $table->boolean('playground')->default(false);
            $table->boolean('sewerage_supply')->default(false);
            $table->boolean('electricity_supply')->default(false);
            $table->boolean('water_supply')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
