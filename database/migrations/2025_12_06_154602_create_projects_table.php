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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            // Basic Information
            $table->string('title'); // Judul project
            $table->string('slug')->unique(); // URL-friendly, contoh: "my-awesome-project"
            $table->text('description'); // Deskripsi singkat untuk card (wajib)
            $table->longText('content')->nullable(); // Deskripsi lengkap untuk detail page (bisa HTML)

            // Media
            $table->string('featured_image')->nullable(); // Cover image utama

            // Classification
            $table->foreignId('category_id') // Foreign key ke project_categories
                ->nullable()
                ->constrained('project_categories')
                ->onDelete('set null'); // Kalo kategori dihapus, set null

            $table->string('role')->nullable(); // Role: "Full Stack Developer", "Backend Developer", etc

            // Status
            $table->enum('status', [
                'active',           // 🟢 Masih aktif di-maintain
                'completed',        // ✅ Sudah selesai
                'archived',         // 📦 Sudah tidak aktif
                'on_hold',          // ⏸️ Ditunda sementara
                'in_development'    // 🚧 Sedang dikembangkan
            ])->default('in_development');

            // Date Information
            $table->string('date')->nullable(); // "Dec 2024" - untuk display
            $table->integer('year'); // 2024 - untuk filtering
            $table->tinyInteger('month')->nullable(); // 12 - untuk filtering

            // External Links
            $table->string('github_url')->nullable(); // Link GitHub repo
            $table->string('demo_url')->nullable(); // Link live demo

            // Features
            $table->boolean('is_featured')->default(false); // Apakah project featured?
            $table->integer('views')->default(0); // Jumlah views
            $table->integer('order')->default(0); // Urutan manual untuk sorting

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('category_id'); // Cepat filter by kategori
            $table->index('status'); // Cepat filter by status
            $table->index('year'); // Cepat filter by tahun
            $table->index('is_featured'); // Cepat ambil featured projects
            $table->index('order'); // Cepat sorting manual
            $table->index('created_at'); // Cepat sorting by tanggal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
