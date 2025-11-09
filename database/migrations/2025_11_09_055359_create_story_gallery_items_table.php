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
        Schema::create('story_gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_url');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Add gallery_title field to stories table
        Schema::table('stories', function (Blueprint $table) {
            $table->string('gallery_title')->default('Our Tea Heritage')->after('journey_intro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_gallery_items');

        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('gallery_title');
        });
    }
};
