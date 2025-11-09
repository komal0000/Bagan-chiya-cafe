<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use App\Models\Timeline;
use App\Models\Value;
use App\Models\TeamMember;


class StoryController extends Controller
{
 public function index()
{
    $story = \App\Models\Story::first();
    $timelineItems = $story ? $story->timelines()->orderBy('year')->get() : collect();
    $values = $story ? $story->values : collect();
    $teamMembers = $story ? $story->teamMembers : collect();
    $galleryItems = \App\Models\StoryGalleryItem::orderBy('order')->get();

    return view('admin.story.index', [
        'badgeText' => $story->hero_badge ?? 'Since Mangsir • Born in Damak',
        'heroTitle' => $story->hero_title ?? 'Our Story',
        'heroSubtitle' => $story->hero_subtitle ?? '',
        'heroDescription' => $story->hero_description ?? '',
        'journeyTitle' => $story->journey_title ?? '',
        'journeyIntro' => $story->journey_intro ?? '',
        'timelineItems' => $timelineItems,
        'story' => $story,
        'values' => $values,
        'teamMembers' => $teamMembers,
        'galleryItems' => $galleryItems,
        'galleryTitle' => $story->gallery_title ?? 'Our Tea Heritage',
        'teamTitle' => $story->team_title ?? 'Meet Our Team',
        'teamIntro' => $story->team_intro ?? '',
        'ctaTitle' => $story->cta_title ?? 'Visit Us in Damak',
        'ctaDescription' => $story->cta_description ?? 'Experience the authentic taste of Nepal\'s finest teas in the heart of where our story began.',
        'ctaLink' => $story->cta_link ?? asset(''),
        'ctaButtonText' => $story->cta_button_text ?? 'Back to Home',
        'missionTitle' => $story->mission_title ?? 'Our Mission',
        'missionText' => $story->mission_text ?? '',
        'valuesTitle' => $story->values_title ?? 'Our Values',
    ]);
}
    public function edit()
    {
        $story = Story::first();
        return view('admin.story.edit', compact('story'));
    }

    public function update(Request $request)
    {
        $story = Story::first();
        if (!$story) {
            $story = Story::create($request->all());
        } else {
            $story->update($request->all());
        }
        return redirect()->route('admin.story.index');
    }

    public function updateHero(Request $request)
    {
        $story = Story::first();
        $data = [
            'hero_badge' => $request->input('badge_text'),
            'hero_title' => $request->input('hero_title'),
            'hero_subtitle' => $request->input('hero_subtitle'),
            'hero_description' => $request->input('hero_description'),
        ];
        if (!$story) {
            $story = Story::create($data);
        } else {
            $story->update($data);
        }
        return redirect()->route('admin.story.index');
    }
    public function updateJourney(Request $request)
{
    $story = \App\Models\Story::first();
    $data = [
        'journey_title' => $request->input('journey_title'),
        'journey_intro' => $request->input('journey_intro'),
    ];
    if (!$story) {
        $story = \App\Models\Story::create($data);
    } else {
        $story->update($data);
    }
    return redirect()->route('admin.story.index');
}

public function storeTimeline(Request $request)
{
    $story = \App\Models\Story::first();
    \App\Models\Timeline::create([
        'story_id' => $story->id,
        'year' => $request->input('year'),
        'location' => $request->input('location'),
        'description' => $request->input('description'),
        'link' => $request->input('link'),
    ]);
    return redirect()->route('admin.story.index');
}

public function updateTimeline(Request $request, Timeline $timeline)
{
    $timeline->update([
        'year' => $request->input('year'),
        'title' => null,
        'location' => $request->input('location'),
        'description' => $request->input('description'),
        'link' => $request->input('link'),
    ]);
    return redirect()->route('admin.story.index');
}
public function destroyTimeline(Timeline $timeline)
{
    $timeline->delete();
    return redirect()->route('admin.story.index');
}


public function updateMission(Request $request)
{
    $story = Story::first();
    $data = [
        'mission_title' => $request->input('mission_title'),
        'mission_text' => $request->input('mission_text'),
    ];
    if (!$story) {
        $story = Story::create($data);
    } else {
        $story->update($data);
    }
    return redirect()->route('admin.story.index');
}

public function updateValuesTitle(Request $request)
{
    $story = Story::first();
    $data = [
        'values_title' => $request->input('values_title'),
    ];
    if (!$story) {
        $story = Story::create($data);
    } else {
        $story->update($data);
    }
    return redirect()->route('admin.story.index');
}
public function storeValue(Request $request)
{
    $story = Story::first();
    $data = [
        'story_id' => $story ? $story->id : null,
        'icon' => $request->input('icon'),
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ];
    \App\Models\Value::create($data);
    return redirect()->route('admin.story.index');
}
public function destroyValue(Value $value)
{
    $value->delete();
    return redirect()->route('admin.story.index');
}
public function updateValue(Request $request, Value $value)
{
    $value->update([
        'icon' => $request->input('icon'),
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ]);
    return redirect()->route('admin.story.index');
}
public function updateTeamTitle(Request $request)
{
    $story = \App\Models\Story::first();
    $data = [
        'team_title' => $request->input('team_title'),
        'team_intro' => $request->input('team_intro'),
    ];
    if (!$story) {
        $story = \App\Models\Story::create($data);
    } else {
        $story->update($data);
    }
    return redirect()->route('admin.story.index');
}


public function storeTeam(Request $request)
{
    $request->validate([
        'icon' => 'required|string',
        'title' => 'required|string',
        'description' => 'required|string',
    ]);

    $story = \App\Models\Story::first();
    if (!$story) {
        return redirect()->back()->with('error', 'No story found. Please create a story first.');
    }

    \App\Models\TeamMember::create([
        'story_id' => $story->id,
        'icon' => $request->input('icon'),
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ]);
    return redirect()->route('admin.story.index')->with('success', 'Team member added!');
}
public function show()
{
    $story = \App\Models\Story::first();
    $timelineItems = $story ? $story->timelines()->orderBy('year')->get() : collect();
    $values = $story ? $story->values : collect();
    $teamMembers = $story ? $story->teamMembers : collect();
    $galleryItems = \App\Models\StoryGalleryItem::orderBy('order')->get();

    return view('story', [
        'story' => $story,
        'timelineItems' => $timelineItems,
        'values' => $values,
        'teamMembers' => $teamMembers,
        'galleryItems' => $galleryItems,
    ]);
}

public function updateTeam(Request $request, \App\Models\TeamMember $teamMember)
{
    $request->validate([
        'icon' => 'required|string',
        'title' => 'required|string',
        'description' => 'required|string',
    ]);
    $teamMember->update([
        'icon' => $request->input('icon'),
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ]);
    return redirect()->route('admin.story.index')->with('success', 'Team member updated!');
}

public function destroyTeam(\App\Models\TeamMember $teamMember)
{
    $teamMember->delete();
    return redirect()->route('admin.story.index')->with('success', 'Team member deleted!');
}

public function updateCta(Request $request)
{
    $story = \App\Models\Story::first();
    $data = [
        'cta_title' => $request->input('cta_title'),
        'cta_description' => $request->input('cta_description'),
        'cta_link' => $request->input('cta_link'),
        'cta_button_text' => $request->input('cta_button_text'),
    ];
    if (!$story) {
        $story = \App\Models\Story::create($data);
    } else {
        $story->update($data);
    }
    return redirect()->route('admin.story.index')->with('success', 'CTA updated!');
}

// Gallery Methods
public function updateGalleryTitle(Request $request)
{
    $request->validate([
        'gallery_title' => 'required|string|max:255',
    ]);

    $story = \App\Models\Story::first();
    if (!$story) {
        $story = \App\Models\Story::create([
            'gallery_title' => $request->input('gallery_title'),
        ]);
    } else {
        $story->update([
            'gallery_title' => $request->input('gallery_title'),
        ]);
    }
    return redirect()->route('admin.story.index')->with('success', 'Gallery title updated!');
}

public function storeGalleryItem(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/story_gallery'), $imageName);
        $imagePath = 'storage/story_gallery/' . $imageName;
    }

    $maxOrder = \App\Models\StoryGalleryItem::max('order') ?? 0;

    \App\Models\StoryGalleryItem::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'image_path' => $imagePath,
        'order' => $maxOrder + 1,
    ]);
    return redirect()->route('admin.story.index')->with('success', 'Gallery item added!');
}

public function updateGalleryItem(Request $request, \App\Models\StoryGalleryItem $galleryItem)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $data = [
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ];

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($galleryItem->image_path && file_exists(public_path($galleryItem->image_path))) {
            unlink(public_path($galleryItem->image_path));
        }

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/story_gallery'), $imageName);
        $data['image_path'] = 'storage/story_gallery/' . $imageName;
    }

    $galleryItem->update($data);
    return redirect()->route('admin.story.index')->with('success', 'Gallery item updated!');
}

public function destroyGalleryItem(\App\Models\StoryGalleryItem $galleryItem)
{
    // Delete image file if exists
    if ($galleryItem->image_path && file_exists(public_path($galleryItem->image_path))) {
        unlink(public_path($galleryItem->image_path));
    }

    $galleryItem->delete();
    return redirect()->route('admin.story.index')->with('success', 'Gallery item deleted!');
}
}
