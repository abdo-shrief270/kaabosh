<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('tagline');
            $table->text('description');
            $table->string('accent_color', 7);
            $table->string('logo')->nullable();
            $table->enum('status', ['live', 'beta', 'coming-soon'])->default('coming-soon');
            $table->json('audiences');
            $table->string('demo_video_url')->nullable();
            $table->string('external_app_url')->nullable();
            $table->string('external_docs_url')->nullable();
            $table->json('seo')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
