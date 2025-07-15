<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'meta_title',
        'meta_description'
    ];
}