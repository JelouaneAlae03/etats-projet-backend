<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateur';

    protected $primaryKey = 'Cle';

    public $timestamps = false;

    protected $fillable = [
        'Nom', 'Mot_Passe', 'Description'
    ];

    protected $hidden = [
        'Mot_Passe', 
    ];

    public function getJWTIdentifier()
    {
        return $this->attributes['Cle'];  
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
