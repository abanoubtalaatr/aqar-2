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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->enum('for_rent', [0, 1, 2])->comment('0=>sell ,1=>rent ,2=>both');
            $table->enum('renting_duration', ['0', '1', '2'])->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('license_number')->nullable();
            $table->bigInteger('price');
            $table->foreignId('currency_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('area');
            $table->integer('length');
            $table->integer('width');
            $table->enum('advertiser_relationship_with_property', [0, 1, 2]);
            $table->text('description');
            $table->string('map_latitude');
            $table->string('map_longitude');
            $table->integer('property_age')->nullable();
            $table->integer('neighborhood_id');
            $table->integer('views_count')->default('0');
            $table->string('adable_type');
            $table->string('adable_id')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('stared')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
