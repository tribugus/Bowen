<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'tw_profesor';
    public $timestamps = true;


    protected $fillable = [

        'genero',
        'date_nacimiento',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'nivel_educativo_id',
        'grado',
        'grupo_id',
        'matricula_id',
        'consecutivo_matricula',
        'matricula_interna',
        'matricula_oficial',
        'nacionalidad',
        'estado_civil',
        'date_ingreso',
        'fecha_ingreso',
        'ciclo_escolar_id',
        'curp',
        'usuario_id',
        'activo',
        
    ];
    
    public function usuario()
    {
        return $this->hasOne(Usuario::class,'id','usuario_id');
    }
    

}
