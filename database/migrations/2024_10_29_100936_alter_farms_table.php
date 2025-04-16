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
        Schema::table('farms', function (Blueprint $table) {
            $table->dropColumn('interface');
            $table->dropColumn('verse');
            $table->dropColumn('number_of_living_rooms');
            $table->dropColumn('amusement_park_games');
            $table->dropColumn('football_field');
            $table->dropColumn('voleyball_field');
            $table->dropColumn('families_or_singles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('farms', function (Blueprint $table) {
            $table->enum('interface', [0,1,2,3,4,5,6,7,8,9]);
            $table->string('verse')->nullable();
            $table->integer('number_of_living_rooms')->nullable();
            $table->boolean('amusement_park_games')->default(false);
            $table->boolean('football_field')->default(false);
            $table->boolean('voleyball_field')->default(false);
            $table->enum('families_or_singles', ['families', 'singles'])->nullable();
        });
    }
};
