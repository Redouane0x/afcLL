<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'type', 'date_heure', 'lieu', 'description'];

    // On dit à Laravel que "date_heure" est une vraie date pour pouvoir la formater facilement
    protected $casts = [
        'date_heure' => 'datetime',
    ];
}
