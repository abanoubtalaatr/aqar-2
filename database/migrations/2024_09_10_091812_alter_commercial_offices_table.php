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
        if (!Schema::hasColumn('commercial_offices', 'room_of_numbers')) {
            Schema::table('commercial_offices', function (Blueprint $table) {
                $table->integer('room_of_numbers')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commercial_offices', function (Blueprint $table) {
            if (Schema::hasColumn('commercial_offices', 'room_of_numbers')) {
                $table->dropColumn('room_of_numbers');
            }
        });
    }
};
