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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('neighborhood_id');
            $table->dropColumn('has_file');
            $table->dropColumn('city_id');
            $table->dropColumn('has_files');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('neighborhood_id');
            $table->boolean('has_files');
            $table->boolean('has_file');
            $table->string('city_id');
        });
    }
};
