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
        Schema::create('project_features', function (Blueprint $table) {
            $table->id();
            // Foreign Key
            $table->foreignId('project_id') // ID project
                ->constrained('projects') // Refer ke table projects
                ->onDelete('cascade'); // Kalo project dihapus, features ikut dihapus

            // Feature Information
            $table->string('title'); // Judul feature, contoh: "High Performance"
            $table->text('description'); // Deskripsi feature, contoh: "99+/100 PageSpeed scores..."
            $table->string('icon_class')->nullable(); // Icon class untuk feature, contoh: "bi bi-lightning"
            $table->tinyInteger('order')->default(1); // Urutan feature (1, 2, 3, dst)

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
        Schema::dropIfExists('project_features');
    }
};
