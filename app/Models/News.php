<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'is_published',
        'is_featured'
    ];

    public function comments()
    {
        return $this->hasMany(NewsComment::class);
    }
}
