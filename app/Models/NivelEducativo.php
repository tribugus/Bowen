<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelEducativo extends Model
{
    use HasFactory;

    protected $table = 'tc_nivel_educativo';
    public $timestamps = true;

    protected $fillable = [
        'clave_identificador',
        'descripcion',
        'director_usuario_id',
        'acuerdo_creacion_incorporacion',
        'date',
        'fecha_incorporacion',
        'zona_escolar',
        'denominacion_grado',
        'grado_ini',
        'grado_fin',
        'matricula_id',
        'activo',
    ];


    public function director()
    {
        return $this->hasOne(Usuario::class,'id','director_usuario_id');
    }

    public function matricula()
    {
        return $this->hasOne(Matricula::class,'id','matricula_id');
    }



}
