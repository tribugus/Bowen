<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;

    protected $table = 'tw_domicilio';
    public $timestamps = true;

    protected $fillable = [
        'estado',
        'ciudad',
        'codigo_postal',
        'domicilio_particular',
        'entre_calles',
        'descripcion',
        'telefono',
        'usuario_id',
    ];


}
