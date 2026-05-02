<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootMatch extends Model
{
    use HasFactory;

    // On définit explicitement le nom de la table au cas où tu aurais déjà créé une table 'matches'
    protected $table = 'matches';

    // On autorise le remplissage de ces colonnes
    protected $fillable = [
        'footclubs_id',
        'competition',
        'date',
        'equipe_domicile',
        'equipe_exterieur',
        'score'
    ];
}
