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
            $table->string('number_of_shops')->nullable()->change();
            $table->dropColumn('number_of_apartment');

            $table->string('number_of_apartments');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buildings', function (Blueprint $table) {
            $table->integer('number_of_shops');
            $table->integer('number_of_apartment');
            $table->dropColumn('number_of_apartments');
        });
    }
};
