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
        Schema::create('store_houses', function (Blueprint $table) {
            $table->id();
            $table->enum('advertiser_characteristic', [0, 1, 2]);
            $table->integer('area');

            $table->enum('Interface', [
                '0', '1', '2', '3',
                '4', '5', '6', '7', '8', '9',
            ]);
            $table->integer('street_width')->nullable();
            $table->integer('number_of_rooms');

            //additional
            $table->boolean('water')->default(false);
            $table->boolean('electricity')->default(false);
            $table->boolean('workers_housing')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_houses');
    }
};
