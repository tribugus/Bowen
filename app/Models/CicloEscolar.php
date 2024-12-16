<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloEscolar extends Model
{
    use HasFactory;

    protected $table = 'tc_ciclo_escolar';
    public $timestamps = true;

    protected $fillable = [
        'ano_ini',
        'ano_fin',
        'periodo',
        'descripcion',
        'denominacion',
        'abreviatura',
        'codigo',
        'date_ini',
        'date_fin',
        'fecha_ini',
        'fecha_fin',
        'activo',
    ];


}
