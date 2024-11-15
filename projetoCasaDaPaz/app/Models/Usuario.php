<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject as ContractsJWTSubject;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements ContractsJWTSubject
{
    use HasFactory;

    protected $fillable = [
       'nome', 'email', 'perfil', 'senha',
];

    protected $hidden = [
        'senha',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
