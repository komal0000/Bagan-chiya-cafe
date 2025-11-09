<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerWordsSection extends Model
{
    protected $table = 'owner_words_section';

    protected $fillable = [
        'title',
        'photo_path',
        'quote',
        'signature',
    ];
}
