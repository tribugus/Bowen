<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    use HasFactory;

    protected $table = 'tw_boleta';
    public $timestamps = true;

    protected $fillable = [
        'alumnno_usuario_id',
        'promedio_general',
        'fecha',
        'ciclo_escolar_id',
    ];


}
