<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcement_bars', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->string('cta_label')->nullable();
            $table->string('cta_url')->nullable();
            $table->string('bg_color')->default('#3b82f6');
            $table->string('text_color')->default('#ffffff');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcement_bars');
    }
};
