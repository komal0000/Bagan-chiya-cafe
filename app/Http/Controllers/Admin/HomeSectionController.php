<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeGallerySection;
use App\Models\OwnerWordsSection;
use App\Models\Gallery;

class HomeSectionController extends Controller
{
    public function index()
    {
        $gallerySection = HomeGallerySection::firstOrCreate(
            [],
            [
                'title' => 'Crafting Moments Since 2081',
                'subtitle' => 'Experience the journey from leaf to cup',
                'button_text' => 'View All Images',
                'button_link' => '/gallery'
            ]
        );

        $ownerWords = OwnerWordsSection::firstOrCreate(
            [],
            [
                'title' => 'Words From Our Founder',
                'photo_url' => 'https://res.cloudinary.com/dzdinuw5d/image/upload/v1754038926/WhatsApp_Image_2025-07-31_at_6.28.54_PM_1_tiivhu.jpg',
                'quote' => 'At Bagan Chiya Cafe, we pour our heart into every cup. Our mission is to share the rich tea culture of Nepal with the world, using only the finest ingredients. Come join us for a taste of tradition!',
                'signature' => '- Sandip Giree, Founder'
            ]
        );

        $gallery = Gallery::all();

        return view('admin.home-sections.index', compact('gallerySection', 'ownerWords', 'gallery'));
    }

    public function updateGallerySection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'button_link' => 'required|string|max:255',
        ]);

        $gallerySection = HomeGallerySection::first();
        $gallerySection->update($request->all());

        return redirect()->back()->with('success', 'Gallery section updated successfully!');
    }

    public function updateOwnerWords(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo_url' => 'nullable|string|max:500',
            'quote' => 'required|string',
            'signature' => 'required|string|max:255',
        ]);

        $ownerWords = OwnerWordsSection::first();
        $ownerWords->update($request->all());

        return redirect()->back()->with('success', 'Owner words section updated successfully!');
    }
}
