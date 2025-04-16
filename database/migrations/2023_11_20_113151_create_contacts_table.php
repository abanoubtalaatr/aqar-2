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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->integer('contact_type')->comment('0 - contact us, 1 - tech support');
            $table->integer('message_type')->comment('0 - selling, 1 - suggestion, 2 - other');
            $table->integer('platform')->comment('0 - website, 1 - android, 2 - ios')->nullable();
            $table->text('message');
            $table->boolean('read');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
