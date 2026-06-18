<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\GalleryImage;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Mention;
use App\Models\Team; // 👈 AJOUT ICI

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
        'role',
        'position',
        'rating',
        'buts',
        'passes',
        'matchs_gagnes',
        'matchs_joues',
        'reussite_passes',
        'pied_fort',
        'taille',
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
    | 🛡️ ROLES & PERMISSIONS
    |--------------------------------------------------------------------------
    */

    // Les rôles disponibles dans l'application
    public const ROLES = [
        'dev',
        'super_admin',
        'admin',
        'joueur_licencie',
        'joueur',
        'user'
    ];

    // Savoir quels rôles cet utilisateur a le droit de donner
    public function assignableRoles(): array
    {
        if ($this->role === 'dev') {
            return self::ROLES; // Le dev peut tout donner
        }

        if ($this->role === 'super_admin') {
            // Le super admin peut tout donner SAUF dev
            return array_values(array_diff(self::ROLES, ['dev']));
        }

        if ($this->role === 'admin') {
            // L'admin ne peut pas donner dev ni super_admin
            return array_values(array_diff(self::ROLES, ['dev', 'super_admin']));
        }

        return []; // Les autres ne peuvent donner aucun rôle
    }

    /*
    |--------------------------------------------------------------------------
    | 🔗 RELATIONS GALERIE & NEWS
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

    public function newsLikes()
    {
        return $this->hasMany(\App\Models\NewsLike::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ⚽ RELATIONS ÉQUIPES
    |--------------------------------------------------------------------------
    */

    /**
     * Un utilisateur (joueur) peut appartenir à plusieurs équipes (ex: A et B).
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}
