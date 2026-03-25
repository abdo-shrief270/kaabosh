<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('type');
            $table->string('title');
            $table->longText('body')->nullable();
            $table->json('seo')->nullable();
            $table->string('locale')->default('en');
            $table->timestamp('last_updated_at')->nullable();
            $table->timestamps();
            $table->unique(['slug', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
