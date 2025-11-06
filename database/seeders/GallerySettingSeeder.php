<?php

namespace Database\Seeders;

use App\Models\GallerySetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gallery Hero Section
        GallerySetting::updateOrCreate(
            ['section' => 'hero'],
            [
                'title' => 'Our Gallery',
                'subtitle' => 'Stories in Every Frame',
                'description' => 'Explore the visual journey of Bagan Chiya Cafe, capturing the essence of our tea heritage and community through stunning photography.',
            ]
        );

        // Photo Gallery Header Section
        GallerySetting::updateOrCreate(
            ['section' => 'header'],
            [
                'title' => 'Tea Garden Gallery',
                'subtitle' => null,
                'description' => 'Discover the beauty of our tea journey through captivating moments from our gardens, ceremonies, and community gatherings',
            ]
        );
    }
}
