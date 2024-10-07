<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'telefone', 'instagram', 'instagram_bazar', 'fanpage', 'email', 'end_bazar', 'end_sede'];
}
