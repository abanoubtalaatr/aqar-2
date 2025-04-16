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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('for_rent', [0, 1, 2]);
            $table->enum('renting_duration', [0, 1, 2]);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('meter_price')->nullable();
            $table->integer('price_from')->nullable();
            $table->integer('price_to')->nullable();
            $table->foreignId('currency_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->integer('area_from')->nullable();
            $table->integer('area_to')->nullable();
            $table->string('map_latitude');
            $table->string('map_longitude');
            $table->string('description');
            $table->integer('neighborhood_id');
            $table->string('orderable_type');
            $table->string('orderable_id')->nullable();
            $table->integer('property_age')->nullable();

            $table->boolean('has_files');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
