<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $fillable = [
        'key',
        'image',
        'order',
        'is_active'
    ];

    public $translatedAttributes = [
        'title',
        'subtitle',
        'description',
        'manufacturers_standard',
        'features',
        'applications'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_products')
                    ->withPivot('order')
                    ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}