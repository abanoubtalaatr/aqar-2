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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('adable');
            $table->string('key');
            $table->string('name_ar');
            $table->string('name_en');
            $table->integer('max_rent_price');
            $table->integer('min_rent_price');
            $table->integer('max_sell_price');
            $table->integer('min_sell_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
