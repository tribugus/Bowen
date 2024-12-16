<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCalificacion extends Model
{
    use HasFactory;

    protected $table = 'tc_tipo_calificacion';
    public $timestamps = true;

    protected $fillable = [
        'resultado',
        'calificacion',
    ];


}
