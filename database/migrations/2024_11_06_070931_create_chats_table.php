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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id');
            $table->foreignId('sender_id')->references('id')->on('users');
            $table->foreignId('receiver_id')->references('id')->on('users');
            $table->timestamp('receiver_read_at')->nullable();
            $table->timestamp('sender_read_at')->nullable();
            $table->text('message')->nullable();
            $table->string('file')->nullable();
            $table->boolean('is_closed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
