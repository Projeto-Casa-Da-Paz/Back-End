<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campanha extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_campanha',
        'data_inicio',
        'data_final',
        'detalhes',
    ];
}

