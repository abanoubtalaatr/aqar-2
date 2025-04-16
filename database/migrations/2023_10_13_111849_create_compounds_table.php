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
        Schema::create('compounds', function (Blueprint $table) {
            $table->id();
            $table->enum('advertiser_characteristic', [0, 1, 2]);
            $table->integer('area');

            $table->integer('number_of_apartments');
            $table->integer('number_of_villas');

            //additional
            $table->boolean('zoo')->default(false);
            $table->boolean('pool')->default(false);
            $table->boolean('volley_ball')->default(false);
            $table->boolean('football')->default(false);
            $table->boolean('toys')->default(false);
            $table->boolean('gym')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compounds');
    }
};
