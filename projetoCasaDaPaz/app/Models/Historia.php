<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    use HasFactory;
    protected $fillable = ['ano_fundacao','MVV','PMH','texto_institucional','foto_capa'];
}
