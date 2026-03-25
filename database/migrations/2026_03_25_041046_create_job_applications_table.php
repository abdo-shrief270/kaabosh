<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_role_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('country');
            $table->string('cv_path');
            $table->string('linkedin_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->text('cover_letter')->nullable();
            $table->string('referral_source')->nullable();
            $table->string('referral_name')->nullable();
            $table->string('diversity_gender')->nullable();
            $table->string('diversity_ethnicity')->nullable();
            $table->string('diversity_disability')->nullable();
            $table->enum('status', ['received', 'reviewing', 'interview', 'offer', 'hired', 'rejected'])->default('received');
            $table->string('reference_number')->unique();
            $table->timestamps();
            $table->index(['job_role_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
