<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GallerySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order')->orderBy('created_at', 'desc')->get();
        $categories = Gallery::select('category')->distinct()->pluck('category');

        // Get gallery settings
        $heroSettings = GallerySetting::where('section', 'hero')->first();
        $headerSettings = GallerySetting::where('section', 'header')->first();

        return view('admin.gallery.index', compact('galleries', 'categories', 'heroSettings', 'headerSettings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category' => 'required|string|max:50',
            'is_featured' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'category' => $request->category,
            'is_featured' => $request->has('is_featured'),
            'order' => Gallery::max('order') + 1,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image added successfully!');
    }

    public function edit(Gallery $gallery)
    {
        return response()->json($gallery);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:50',
            'is_featured' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'is_featured' => $request->has('is_featured'),
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully!');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'required|integer',
        ]);

        foreach ($request->orders as $id => $order) {
            Gallery::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'section' => 'required|in:hero,header',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        GallerySetting::updateOrCreate(
            ['section' => $request->section],
            [
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'description' => $request->description,
            ]
        );

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery settings updated successfully!');
    }
}
