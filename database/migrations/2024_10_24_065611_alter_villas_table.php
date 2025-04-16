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
            $table->boolean('has_interior_staircase')->nullable();
            $table->boolean('has_attached')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('villas', function (Blueprint $table) {
            $table->dropColumn('has_interior_staircase');
            $table->dropColumn('has_attached');
        });
    }
};
