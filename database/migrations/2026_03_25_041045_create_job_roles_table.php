<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_roles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('department');
            $table->string('location');
            $table->string('work_type');
            $table->string('employment_type')->default('full-time');
            $table->string('experience_level')->nullable();
            $table->text('summary');
            $table->text('about_team')->nullable();
            $table->json('responsibilities');
            $table->json('requirements');
            $table->json('nice_to_have')->nullable();
            $table->json('what_we_offer');
            $table->json('hiring_process')->nullable();
            $table->string('salary_range')->nullable();
            $table->boolean('requires_portfolio')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('seo')->nullable();
            $table->timestamp('posted_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['is_active', 'department']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_roles');
    }
};
