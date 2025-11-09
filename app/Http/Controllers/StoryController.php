<?php
namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{


public function show()
{
    $story = \App\Models\Story::first();
    $timelineItems = $story ? $story->timelines()->orderBy('year')->get() : collect();
    $values = $story ? $story->values : collect();
    $teamMembers = $story ? $story->teamMembers : collect();
    $galleryItems = \App\Models\StoryGalleryItem::orderBy('order')->get();

    return view('story', compact('story', 'timelineItems', 'values', 'teamMembers', 'galleryItems'));
}
}
