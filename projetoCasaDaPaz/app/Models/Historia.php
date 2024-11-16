<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    use HasFactory;

    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'ano_fundacao',
        'MVV',
        'PMH',
        'texto_institucional',
        'foto_capa',
    ];

    /**
     * Atributos que devem ser convertidos para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'ano_fundacao' => 'date',
    ];

    /**
     * Accessor para obter o caminho completo da foto de capa.
     *
     * @return string|null
     */
    public function getFotoCapaUrlAttribute()
    {
        return $this->foto_capa ? asset('storage/fotos_capa/' . $this->foto_capa) : null;
    }
}
