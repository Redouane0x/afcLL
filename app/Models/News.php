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

    // 💬 COMMENTAIRES
    public function comments()
    {
        return $this->hasMany(NewsComment::class);
    }

    // ❤️ LIKES (AJOUT IMPORTANT)
    public function likes()
    {
        return $this->hasMany(\App\Models\NewsLike::class);
    }

}
