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
        Schema::table('floors', function (Blueprint $table) {
            $table->dropColumn('number_of_living_rooms');
            $table->dropColumn('air_conditioner');
            $table->dropColumn('car_entrance');
            $table->dropColumn('in_villa');
            $table->dropColumn('private_entrance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('floors', function (Blueprint $table) {
            $table->string('number_of_living_rooms')->nullable();
            $table->boolean('air_conditioner')->default(false);
            $table->boolean('car_entrance')->default(false);
            $table->boolean('in_villa')->default(false);
            $table->boolean('private_entrance')->default(false);
        });
    }
};
