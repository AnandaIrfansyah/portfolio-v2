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
        Schema::table('guestbook_messages', function (Blueprint $table) {
            $table->boolean('is_pinned')->default(false)->after('is_author');
            $table->boolean('is_hidden')->default(false)->after('is_pinned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guestbook_messages', function (Blueprint $table) {
            $table->dropColumn(['is_pinned', 'is_hidden']);
        });
    }
};
