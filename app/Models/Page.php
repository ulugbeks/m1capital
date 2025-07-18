<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Page extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'slug',
        'type',
        'is_active',
        'order'
    ];

    public $translatedAttributes = [
        'title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'hero_title',
        'hero_subtitle',
        'card_title',
        'card_text',
        'content'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getContentAttribute()
    {
        $raw = $this->translate()?->getAttributes()['content'] ?? null;

        if (is_string($raw)) {
            return json_decode($raw, true) ?? [];
        }

        if (is_array($raw)) {
            return $raw;
        }

        return [];
    }

    public function getSectionData($section)
    {
        $content = $this->content;
        return $content[$section] ?? null;
    }
}