<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'tw_calificacion';
    public $timestamps = true;

    protected $fillable = [
        'materia_id',
        'boleta_id',
        'tipo_calificacion_id',
        'maestro_usuario_id',
    ];


}
