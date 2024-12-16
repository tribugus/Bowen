<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'tw_profesor';
    public $timestamps = true;


    protected $fillable = [
        'clave_profesor',
        'genero_usuario_id',
        'date',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'estado_civil_id',
        'curp',
        'no_seguro_social',
        'cedula_fiscal_rfc',
        'usuario_id',
        'activo',
    ];

    
    public function usuario()
    {
        return $this->hasOne(Usuario::class,'id','usuario_id');
    }
    

}
