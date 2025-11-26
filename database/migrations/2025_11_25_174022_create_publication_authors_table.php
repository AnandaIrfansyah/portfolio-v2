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
        Schema::create('publication_authors', function (Blueprint $table) {
            // ✅ HAPUS $table->id(); <- INI DIHAPUS!

            $table->foreignId('publication_id')
                ->constrained('publications')
                ->onDelete('cascade');

            $table->foreignId('author_id')
                ->constrained('authors')
                ->onDelete('cascade');

            $table->tinyInteger('author_order')->default(1);
            $table->timestamps();

            $table->primary(['publication_id', 'author_id']);
            $table->index('author_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_authors');
    }
};
