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
        Schema::table('cities', function (Blueprint $table) {
            $table->string('latitude_min')->nullable();
            $table->string('latitude_max')->nullable();
            $table->string('longitude_min')->nullable();
            $table->string('longitude_max')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('latitude_min');
            $table->dropColumn('latitude_max');
            $table->dropColumn('longitude_min');
            $table->dropColumn('longitude_max');
        });
    }
};
