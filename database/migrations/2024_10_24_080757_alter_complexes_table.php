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
        Schema::table('complexes', function (Blueprint $table) {
            $table->dropColumn('is_cellar');
            $table->boolean('has_cellar')->default(0);

            $table->dropColumn('is_offices');
            $table->boolean('has_offices')->default(0);

            $table->dropColumn('number_of_unit');
            $table->string('number_of_units')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complexes', function (Blueprint $table) {
            //
        });
    }
};
