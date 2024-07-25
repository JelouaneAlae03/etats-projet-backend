<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'utilisateur';

    protected $primaryKey = 'cle';

    public $timestamps = false;

    protected $fillable = [
        'Nom', 'Mot_Passe', 'Description'
    ];

    protected $hidden = [
        'Mot_passe',
    ];
}
