<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoAlumno extends Model
{
    use HasFactory;

    protected $table = 'tr_grupo_alumno';
    public $timestamps = true;

    protected $fillable = [
        'maestro_usuario_id',
        'tutor_usuario_id',
        'alumnno_usuario_id',
        'ciclo_escolar_id',
    ];


}
