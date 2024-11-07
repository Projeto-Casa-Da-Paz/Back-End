<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_galeria',
        'descricao',
        'nome',
        'file',
    ];
    public function galeria()
    {
        return $this->belongsTo(Galeria::class, 'id_galeria');
    }
}
