<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'documento', 'id_diretorio'];
    public function diretorio()
    {
        return $this->belongsTo(Galeria::class, 'id_diretorio');
    }
}
