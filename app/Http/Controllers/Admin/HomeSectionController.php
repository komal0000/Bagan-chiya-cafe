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
                'photo_path' => null,
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'quote' => 'required|string',
            'signature' => 'required|string|max:255',
        ]);

        $ownerWords = OwnerWordsSection::first();

        $data = [
            'title' => $request->input('title'),
            'quote' => $request->input('quote'),
            'signature' => $request->input('signature'),
        ];

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($ownerWords->photo_path && file_exists(public_path($ownerWords->photo_path))) {
                unlink(public_path($ownerWords->photo_path));
            }

            $photo = $request->file('photo');
            $photoName = time() . '_owner.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('storage/owner_photos'), $photoName);
            $data['photo_path'] = 'storage/owner_photos/' . $photoName;
        }

        $ownerWords->update($data);

        return redirect()->back()->with('success', 'Owner words section updated successfully!');
    }
}
