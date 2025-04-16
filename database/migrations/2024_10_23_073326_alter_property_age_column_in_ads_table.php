<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->string('property_age')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->integer('property_age')->nullable()->change();
        });
    }

};
