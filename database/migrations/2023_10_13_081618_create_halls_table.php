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
        Schema::create('halls', function (Blueprint $table) {
            $table->id();

            $table->integer('street_width')->nullable();
            $table->integer('number_of_wells');
            $table->integer('number_of_trees');
            $table->integer('number_of_living_rooms');

            // additional
            $table->boolean('kitchen')->default(false);
            $table->boolean('car_entrance')->default(false);

            $table->boolean('verse')->default(false);
            $table->boolean('water_supply')->default(false);
            $table->boolean('electricity_supply')->default(false);
            $table->boolean('sewerage_supply')->default(false);

            $table->enum('families_or_singles', ['0', '1', '2']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
