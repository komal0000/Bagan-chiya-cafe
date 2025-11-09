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
        // Rename image_url to image_path in story_gallery_items
        Schema::table('story_gallery_items', function (Blueprint $table) {
            $table->renameColumn('image_url', 'image_path');
        });

        // Rename photo_url to photo_path in owner_words_section
        Schema::table('owner_words_section', function (Blueprint $table) {
            $table->renameColumn('photo_url', 'photo_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert image_path back to image_url in story_gallery_items
        Schema::table('story_gallery_items', function (Blueprint $table) {
            $table->renameColumn('image_path', 'image_url');
        });

        // Revert photo_path back to photo_url in owner_words_section
        Schema::table('owner_words_section', function (Blueprint $table) {
            $table->renameColumn('photo_path', 'photo_url');
        });
    }
};
