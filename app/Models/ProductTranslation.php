<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'manufacturers_standard',
        'features',
        'applications'
    ];

    protected $casts = [
        'features' => 'array',
        'applications' => 'array'
    ];
}