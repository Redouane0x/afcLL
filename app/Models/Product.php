<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*
    |--------------------------------------------------------------------------
    | 🔥 MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'image_url',
        'type',
        'customizable',
        'sizes',
        'material',
        'dimensions',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🎯 CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'customizable' => 'boolean',
        'price' => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🔗 RELATIONS
    |--------------------------------------------------------------------------
    */

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'custom_name', 'custom_number')
            ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | 🧠 HELPERS
    |--------------------------------------------------------------------------
    */

    public function isCustomizable()
    {
        return $this->customizable;
    }

    public function isClothing()
    {
        return in_array($this->type, ['tshirt', 'short', 'manteau']);
    }

    public function getSizesArrayAttribute()
    {
        return $this->sizes
            ? array_map('trim', explode(',', $this->sizes))
            : [];
    }
}
