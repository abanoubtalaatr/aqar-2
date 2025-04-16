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
        if (!Schema::hasTable('commercial_offices')) {
            Schema::create('commercial_offices', function (Blueprint $table) {
                $table->id();

                $table->enum('Interface', [
                    '0', '1', '2', '3',
                    '4', '5', '6', '7', '8', '9',
                ]);
                $table->integer('street_width')->nullable();
                $table->boolean('furnished')->default(false);
                $table->boolean('sewerage_supply')->default(false);
                $table->boolean('electricity_supply')->default(false);
                $table->boolean('water_supply')->default(false);

                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_lands');
    }
};
