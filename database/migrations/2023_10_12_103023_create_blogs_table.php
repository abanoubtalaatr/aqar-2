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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('0 =>construction_and_contracting, 1=>rating_neighborhood ,2=>decoration ,3=>real_estate_news ,4=>garas_reports');
            $table->foreignId('neighborhood_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name_ar');
            $table->string('name_en');
            $table->longText('short_description_ar');
            $table->longText('short_description_en');
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
