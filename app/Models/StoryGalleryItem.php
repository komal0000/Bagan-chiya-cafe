<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryGalleryItem extends Model
{
    protected $table = 'story_gallery_items';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'order',
    ];
}
