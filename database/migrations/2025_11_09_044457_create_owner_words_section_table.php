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
        Schema::create('owner_words_section', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Words From Our Founder');
            $table->string('photo_url')->nullable();
            $table->text('quote');
            $table->string('signature')->default('- Sandip Giree, Founder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_words_section');
    }
};
