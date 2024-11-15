<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bazar extends Model
{
    use HasFactory;
    protected $fillable = ['periodo_atividade', 'localidade', 'contato', 'foto'];
}
