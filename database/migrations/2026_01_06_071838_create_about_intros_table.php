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
        Schema::create('about_intros', function (Blueprint $table) {
            $table->id();
            $table->longText('bio');
            $table->enum('status', ['open_to_work', 'not_available'])->default('open_to_work');
            $table->string('cv_pdf_file')->nullable();
            $table->string('cv_word_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_intros');
    }
};
