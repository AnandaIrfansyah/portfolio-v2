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
        Schema::create('publications', function (Blueprint $table) {
            // Primary Key
            $table->id();

            // Basic Information
            $table->string('title'); // Judul publikasi
            $table->string('slug')->unique(); // URL-friendly version dari title, contoh: "my-research-paper"

            // Publication Classification
            $table->enum('publication_type', [
                'journal',        // Paper yang dipublish di journal ilmiah
                'conference',     // Paper yang dipresentasikan di conference
                'preprint',       // Draft paper yang belum direview (arxiv, etc)
                'thesis',         // Skripsi/Thesis/Disertasi
                'book_chapter',   // Chapter di dalam buku
                'workshop'        // Paper workshop
            ])->default('journal');

            $table->string('venue')->nullable(); // Nama journal/conference, contoh: "IEEE Transactions"

            // Date Information
            $table->integer('year'); // Tahun publikasi, contoh: 2024
            $table->tinyInteger('month')->nullable(); // Bulan publikasi (1-12), nullable karena kadang cuma tahun

            // Content
            $table->text('abstract'); // Ringkasan/abstrak dari paper (wajib ada)
            $table->longText('content')->nullable(); // Isi lengkap paper dalam format HTML/Markdown (optional)

            // Media
            $table->string('featured_image')->nullable(); // Cover image untuk publikasi

            // External Links & Identifiers
            $table->string('doi', 100)->nullable(); // Digital Object Identifier, contoh: "10.1109/CVPR.2024.12345"
            $table->string('url')->nullable(); // Link ke halaman publikasi resmi
            $table->string('pdf_url')->nullable(); // Link direct download PDF

            // Metrics
            $table->integer('citation_count')->default(0); // Jumlah paper lain yang mengutip publikasi ini
            $table->integer('views')->default(0); // Jumlah orang yang view detail page

            // Status & Features
            $table->enum('status', [
                'published',      // Sudah dipublish resmi
                'accepted',       // Diterima tapi belum publish
                'under_review',   // Sedang direview
                'preprint'        // Draft/belum direview
            ])->default('published');

            $table->boolean('is_featured')->default(false); // Tandai publikasi penting untuk ditampilkan di homepage

            // Timestamps (created_at & updated_at)
            $table->timestamps();

            // Indexes - untuk mempercepat query
            $table->index('publication_type'); // Cepat filter berdasarkan tipe
            $table->index('year'); // Cepat filter berdasarkan tahun
            $table->index('status'); // Cepat filter berdasarkan status
            $table->index('is_featured'); // Cepat ambil publikasi featured
            $table->index('created_at'); // Cepat sorting berdasarkan tanggal dibuat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
