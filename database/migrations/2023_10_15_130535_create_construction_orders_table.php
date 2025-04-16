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
        // Uncomment this part to actually create the table
        Schema::create('construction_orders', function (Blueprint $table) {
            $table->id();
            $table->boolean('seen')->default(0);
            $table->integer('service_type')->comment('0 for Residential construction, 1 for engineering charts, 2 for Construction supervision, 3 for Purchasing consulting, 4 for Interior Design');
            $table->string('phone_number');
            $table->string('city');
            $table->longText('service_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('construction_orders');
    }
};
