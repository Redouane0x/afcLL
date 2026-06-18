<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * C'est ce qui règle ton erreur MassAssignmentException.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'document_path',
        'type_demande',
        'status',
    ];

    /**
     * Relation : Une licence appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
