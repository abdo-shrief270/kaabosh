<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('first_name')->nullable();
            $table->string('product_interest')->nullable();
            $table->string('source');
            $table->string('locale')->default('en');
            $table->timestamps();
            $table->unique(['email', 'source']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
