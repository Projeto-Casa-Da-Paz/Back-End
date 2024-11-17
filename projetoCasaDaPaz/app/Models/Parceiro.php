<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Parceiro extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'classificacao', 'data_inicio', 'imagem'];

    public function getImagemUrlAttribute()
    {
        return $this->imagem ? Storage::url($this->imagem) : null;
    }
}
