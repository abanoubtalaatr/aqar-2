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
        Schema::table('ads', function (Blueprint $table) {
            $table->boolean('for_rent')->nullable()->change();
            $table->foreignId('category_id')->nullable()->change();
            $table->foreignId('user_id')->nullable()->change();
            $table->double('price')->nullable()->change();
            $table->foreignId('currency_id')->nullable()->change();
            $table->integer('length')->nullable()->change();
            $table->integer('area')->nullable()->change();
            $table->integer('width')->nullable()->change();
            $table->integer('views_count')->nullable()->change();
            $table->integer('advertiser_relationship_with_property')->nullable()->change();
            $table->longText('description')->nullable()->change();
            $table->string('map_latitude')->nullable()->change();
            $table->string('map_longitude')->nullable()->change();
            $table->foreignId('neighborhood_id')->nullable()->change();
            $table->integer('adable_id')->nullable()->change();
            $table->string('adable_type')->nullable()->change();
            $table->integer('stared')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            //
        });
    }
};
