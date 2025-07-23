<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $fillable = [
        'title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'hero_title',
        'hero_subtitle',
        'card_title',
        'card_text',
        'content',
        'rellax_image',
        'info_image',
        'rellax_mini_image'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getContentAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}