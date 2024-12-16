<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'tc_matricula';
    public $timestamps = true;

    protected $fillable = [
        'formato',
        'activo',
        'ini_matricula',
        'consecutivo_matricula',
        'limite_matricula',
        'permitir_modificar',
    ];


    public function nivel_educativo()
    {
        return $this->hasOne(NivelEducativo::class,'matricula_id','id');
    }


}
