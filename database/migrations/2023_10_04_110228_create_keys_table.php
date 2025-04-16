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
        Schema::create('keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name_ar');
            $table->string('name_en');
            $table->boolean('show_in_order')->default(0);
            $table->string('attribute_name')->nullable();
            $table->enum('type', ['textarea', 'text', 'number', 'number_with_select ', 'range', 'checkbox', 'select', 'radio']);
            $table->boolean('is_required');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keys');
    }
};
