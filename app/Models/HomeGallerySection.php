<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeGallerySection extends Model
{
    protected $table = 'home_gallery_section';

    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_link',
    ];
}
