<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    protected $fillable = [
        'user_id',
        'gallery_image_id'
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

    public function image()
    {
        return $this->belongsTo(GalleryImage::class, 'gallery_image_id');
    }
}
