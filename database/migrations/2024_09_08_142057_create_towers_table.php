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
        Schema::create('towers', function (Blueprint $table) {
            $table->id();
            $table->integer('street_width')->nullable();
            // additional

            $table->integer('number_of_floors');
            $table->integer('number_of_elevators');
            $table->boolean('is_cellar')->default(0);
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
        Schema::dropIfExists('towers');
    }
};
