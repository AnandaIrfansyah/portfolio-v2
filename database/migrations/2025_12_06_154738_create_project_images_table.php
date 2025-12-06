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
        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            // Foreign Key
            $table->foreignId('project_id') // ID project
                ->constrained('projects') // Refer ke table projects
                ->onDelete('cascade'); // Kalo project dihapus, gambar ikut dihapus

            // Image Information
            $table->string('image_path'); // Path gambar di storage
            $table->tinyInteger('order')->default(1); // Urutan gambar (1, 2, 3, dst)
            $table->string('caption')->nullable(); // Caption/deskripsi gambar (optional)

            // Timestamps
            $table->timestamps();

            // Index
            $table->index('order'); // Cepat sorting berdasarkan urutan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_images');
    }
};
