<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeria extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nome', 'data', 'local'];

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'id_galeria');
    }
}
