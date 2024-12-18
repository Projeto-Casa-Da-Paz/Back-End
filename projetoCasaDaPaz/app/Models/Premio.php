<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Premio extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['nome', 'categoria', 'data_recebimento', 'imagem'];
}
