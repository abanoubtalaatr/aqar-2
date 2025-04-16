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
        Schema::table('rests', function (Blueprint $table) {
            $table->dropColumn('interface');
            $table->dropColumn('number_of_living_rooms');
            $table->dropColumn('families_or_singles');
            $table->dropColumn('football_field');
            $table->dropColumn('volleyball_field');
            $table->dropColumn('verse');
            $table->dropColumn('amusement_park_games');
            $table->dropColumn('family_area');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rests', function (Blueprint $table) {
            $table->enum('interface', [0,1,2,3,4,5,6,7,8,9])->nullable();
            $table->string('number_of_living_rooms')->nullable();
            $table->boolean('families_or_singles')->default(0);
            $table->boolean('football_field')->default(0);
            $table->boolean('volleyball_field')->default(0);
            $table->boolean('verse')->default(0);
            $table->boolean('amusement_park_games')->default(0);
            $table->boolean('family_area')->default(0);
        });
    }
};
