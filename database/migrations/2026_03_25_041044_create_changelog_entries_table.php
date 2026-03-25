<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('changelog_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['new', 'improved', 'fixed']);
            $table->string('version')->nullable();
            $table->date('release_date');
            $table->timestamps();
            $table->index(['product_id', 'release_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('changelog_entries');
    }
};
