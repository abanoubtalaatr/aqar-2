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
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign('ads_currency_id_foreign');
            $table->dropColumn('currency_id');
            $table->dropColumn('advertiser_relationship_with_property');
            $table->dropColumn('neighborhood_id');
            $table->dropColumn('stared');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->bigInteger('currency_id');
            $table->integer('advertiser_relationship_with_property');
            $table->bigInteger('neighborhood_id');
            $table->integer('stared');
        });
    }
};
