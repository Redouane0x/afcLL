<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuvetteProduct extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock',
        'image'
    ];
}
