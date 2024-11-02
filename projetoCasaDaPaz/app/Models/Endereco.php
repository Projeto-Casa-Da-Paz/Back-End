<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $fillable = ['local', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep'];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }
}
