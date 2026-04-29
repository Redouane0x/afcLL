<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // ✅ ICI (en haut)
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    // ✅ RELATION
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'custom_name', 'custom_number')
            ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
