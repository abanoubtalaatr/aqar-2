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
        Schema::create('chalets', function (Blueprint $table) {
            $table->id();

            $table->integer('street_width')->nullable();
            $table->integer('number_of_rooms');
            $table->integer('number_of_living_rooms');
            $table->integer('number_of_bathrooms');

            // additional
            $table->boolean('kitchen')->default(false);
            $table->boolean('pool')->default(false);
            $table->boolean('car_entrance')->default(false);
            // $table->enum('families_or_singles', ['families', 'singles', 'both']);
            $table->enum('families_or_singles', ['0', '1', '2']);
            $table->boolean('football_field')->default(false);
            $table->boolean('volleyball_field')->default(false);
            $table->boolean('amusement_park_games')->default(false);
            $table->boolean('family_area')->default(false);
            $table->boolean('verse')->default(false);
            $table->boolean('water_supply')->default(false);
            $table->boolean('electricity_supply')->default(false);
            $table->boolean('sewerage_supply')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chalets');
    }
};
