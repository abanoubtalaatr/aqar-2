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
        if (! Schema::hasTable('mortgage_orders')) {

            Schema::create('mortgage_orders', function (Blueprint $table) {
                $table->id();
                $table->boolean('seen')->default(0);
                $table->boolean('have_personal_finance')->default(false);
                $table->boolean('Eligible_for_support')->default(false);
                $table->boolean('arabic_date')->default(false);
                $table->timestamp('date_of_birth');
                $table->integer('salary');
                $table->integer('monthly_Commitments');
                $table->string('job');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MortgageOrders');
    }
};
