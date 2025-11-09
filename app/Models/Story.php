<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'hero_badge',
        'hero_title',
        'hero_description',
        'journey_title',
        'journey_intro',
        'mission_title',
        'mission_text',
        'values_title',
        'team_title',
        'team_intro',
        'cta_title',
        'cta_intro',
        'cta_link',
        'cta_button',
        'gallery_title',
        'hero_subtitle',
        'cta_description',
        'cta_button_text',

    ];
    public function timelines()
    {
        return $this->hasMany(\App\Models\Timeline::class);
    }
    public function values()
{
    return $this->hasMany(\App\Models\Value::class);
}
public function teamMembers()
{
    return $this->hasMany(\App\Models\TeamMember::class);
}
}
