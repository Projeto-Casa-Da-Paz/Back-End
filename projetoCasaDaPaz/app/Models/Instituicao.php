<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cnpj', 'telefone', 'email'];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

    public function redesSociais()
    {
        return $this->hasMany(RedeSocial::class);
    }
}
