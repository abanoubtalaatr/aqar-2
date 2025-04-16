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
        Schema::table('villas', function (Blueprint $table) {
            $table->dropColumn('interface');
            $table->dropColumn('number_of_living_rooms');
            $table->dropColumn('air_conditioner');
            $table->dropColumn('attachment');
            $table->dropColumn('families_or_singles');
            $table->dropColumn('basement');
            $table->dropColumn('living_room_stairs');
            $table->dropColumn('duplex');
            $table->dropColumn('playground');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('villas', function (Blueprint $table) {
            $table->string('interface')->nullable();
            $table->integer('number_of_living_rooms')->nullable();
            $table->boolean('air_conditioner')->default(false);
            $table->string('attachment')->nullable();
            $table->enum('families_or_singles', ['families', 'singles'])->nullable();
            $table->boolean('basement')->default(false);
            $table->boolean('living_room_stairs')->default(false);
            $table->boolean('duplex')->default(false);
            $table->boolean('playground')->default(false);
        });
    }
};
