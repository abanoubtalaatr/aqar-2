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
        Schema::create('furnished_apartments', function (Blueprint $table) {
            $table->id();

            $table->integer('street_width')->nullable(); // in sell only

            $table->integer('number_of_rooms');
            $table->integer('number_of_living_rooms');

            // $table->enum('renting_duration', ['daily', 'mounthly', 'yearly'])->nullable();
            $table->integer('floor_number');

            // additional

            // $table->enum('families_or_singles', ['families', 'singles', 'both']);
            $table->enum('families_or_singles', ['0', '1', '2']);

            $table->boolean('sewerage_supply')->default(false);

            $table->boolean('furnished')->default(false);
            $table->boolean('kitchen')->default(false);
            $table->boolean('private_roof')->default(false);
            $table->boolean('in_villa')->default(false);
            $table->boolean('two_entrance')->default(false);
            $table->boolean('private_entrance')->default(false);
            $table->boolean('elevator')->default(false);
            $table->boolean('electricity_supply')->default(false);
            $table->boolean('water_supply')->default(false);
            $table->boolean('air_conditioner')->default(false);
            $table->boolean('attachment')->default(false);
            $table->boolean('car_entrance')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furnished_apartments');
    }
};
