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
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('street_width');
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->boolean('is_equipped')->default(0);
            $table->boolean('is_rented')->default(0);
            $table->boolean('water_supply')->default(0);
            $table->boolean('electricity_supply')->default(0);
            $table->boolean('sewerage_supply')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
