<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'image_url',
        'description',
        'user_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | 🔗 RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function mentions()
    {
        return $this->hasMany(Mention::class);
    }
}
