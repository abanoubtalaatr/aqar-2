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
        Schema::table('buildings', function (Blueprint $table) {
            $table->integer('number_of_shops_from')->nullable();
            $table->integer('number_of_shops_to')->nullable();
            $table->integer('number_of_apartments_from')->nullable();
            $table->integer('number_of_apartments_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buildings', function (Blueprint $table) {
            //
        });
    }
};
