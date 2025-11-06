<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GallerySetting;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('is_featured', 'desc')
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Gallery::select('category')->distinct()->pluck('category');

        // Get gallery settings
        $heroSettings = GallerySetting::where('section', 'hero')->first();
        $headerSettings = GallerySetting::where('section', 'header')->first();

        return view('gallery', compact('galleries', 'categories', 'heroSettings', 'headerSettings'));
    }
}
