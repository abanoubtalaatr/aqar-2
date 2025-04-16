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
            $table->dropColumn('interface');
            $table->dropColumn('private_entrance');
            $table->dropColumn('basement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buildings', function (Blueprint $table) {
            $table->enum('interface', [0,1,2,3,4,5,6,7,8,9]);
            $table->boolean('private_entrance')->default(0);
            $table->boolean('basement')->default(0);
        });
    }
};
