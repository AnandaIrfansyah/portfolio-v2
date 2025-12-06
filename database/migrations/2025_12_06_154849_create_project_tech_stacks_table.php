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
        Schema::create('project_tech_stacks', function (Blueprint $table) {
            $table->foreignId('project_id') // ID project
                ->constrained('projects') // Refer ke table projects
                ->onDelete('cascade'); // Kalo project dihapus, pivot ikut dihapus

            $table->foreignId('tech_stack_id') // ID tech stack
                ->constrained('tech_stacks') // Refer ke table tech_stacks
                ->onDelete('cascade'); // Kalo tech stack dihapus, pivot ikut dihapus

            // Timestamps
            $table->timestamps();

            // Composite Primary Key
            $table->primary(['project_id', 'tech_stack_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tech_stacks');
    }
};
