<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\GalleryImage;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Mention;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | 🔥 MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🔒 HIDDEN
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🎯 CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🔗 RELATIONS GALERIE
    |--------------------------------------------------------------------------
    */

    public function likedImages()
    {
        return $this->belongsToMany(GalleryImage::class, 'likes');
    }

    public function mentionedImages()
    {
        return $this->belongsToMany(GalleryImage::class, 'mentions');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function mentions()
    {
        return $this->hasMany(Mention::class);
    }

    public function newsComments()
    {
        return $this->hasMany(\App\Models\NewsComment::class);
    }
}
