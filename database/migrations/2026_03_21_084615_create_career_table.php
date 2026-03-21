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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            // CV & Status
            $table->string('status')->default('actively_looking'); // actively_looking, open, not_available
            $table->string('availability')->nullable(); // "Within 1 month"
            $table->string('employment_type')->nullable(); // "Full-time, Contract"
            $table->string('remote_work')->nullable(); // "Available"
            $table->string('relocation')->nullable(); // "Open to Relocate"

            // Preferred Roles & Skills
            $table->json('preferred_roles')->nullable(); // ["AI Engineer", "Full Stack"]
            $table->json('skills')->nullable(); // ["Laravel", "Vue.js"]

            // Professional Details
            $table->string('experience_level')->nullable(); // "Mid-Level (2-4 years)"
            $table->string('salary_expectation')->nullable(); // "Competitive / Negotiable"
            $table->string('notice_period')->nullable(); // "1 month"
            $table->string('work_authorization')->nullable(); // "Indonesian Citizen"

            // Languages & Preferences
            $table->string('languages')->nullable(); // "Indonesian (Native), English (Professional)"
            $table->string('contact_preference')->nullable(); // "LinkedIn, Email"
            $table->string('interview_availability')->nullable(); // "Flexible"

            // Location Preferences
            $table->json('work_arrangements')->nullable(); // ["On-site", "Hybrid", "Remote"]
            $table->json('onsite_locations')->nullable(); // ["Jakarta", "Yogyakarta"]
            $table->json('remote_locations')->nullable(); // ["Indonesia", "Malaysia"]

            // Tools & Technologies (array of {category, tools})
            $table->json('tools_technologies')->nullable();

            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
