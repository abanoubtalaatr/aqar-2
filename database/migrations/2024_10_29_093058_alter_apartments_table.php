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
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn('number_of_living_rooms');
            $table->dropColumn('families_or_singles');
            $table->dropColumn('in_villa');
            $table->dropColumn('private_roof');
            $table->dropColumn('air_conditioner');
            $table->dropColumn('attachment');
            $table->dropColumn('private_entrance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->integer('number_of_living_rooms')->nullable();
            $table->enum('families_or_singles', ['families', 'singles'])->nullable();
            $table->boolean('in_villa')->default(false);
            $table->boolean('private_roof')->default(false);
            $table->boolean('air_conditioner')->default(false);
            $table->string('attachment')->nullable();
            $table->boolean('private_entrance')->default(false);
        });
    }
};
