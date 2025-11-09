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
        Schema::create('home_gallery_section', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Crafting Moments Since 2081');
            $table->string('subtitle')->default('Experience the journey from leaf to cup');
            $table->string('button_text')->default('View All Images');
            $table->string('button_link')->default('/gallery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_gallery_section');
    }
};
