<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guestbook_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guestbook_message_id')->constrained()->cascadeOnDelete();
            $table->foreignId('guestbook_user_id')->constrained()->cascadeOnDelete();
            $table->unique(['guestbook_message_id', 'guestbook_user_id']); // 1 user 1 like per pesan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guestbook_likes');
    }
};
