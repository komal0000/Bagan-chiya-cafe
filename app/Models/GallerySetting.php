<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GallerySetting extends Model
{
    protected $fillable = [
        'section',
        'title',
        'subtitle',
        'description',
    ];
}
