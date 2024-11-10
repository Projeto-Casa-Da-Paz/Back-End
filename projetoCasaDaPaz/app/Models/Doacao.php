<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'banco',
        'agencia',
        'conta_corrente',
        'cnpj',
        'titular',
        'chave_pix',
    ];
}
