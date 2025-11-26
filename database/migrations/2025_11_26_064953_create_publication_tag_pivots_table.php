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
        Schema::create('publication_tag_pivots', function (Blueprint $table) {
            // ✅ HAPUS $table->id(); <- INI DIHAPUS!

            $table->foreignId('publication_id')
                ->constrained('publications')
                ->onDelete('cascade');

            $table->foreignId('tag_id')
                ->constrained('publication_tags')
                ->onDelete('cascade');

            $table->timestamps();

            $table->primary(['publication_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_tag_pivots');
    }
};
