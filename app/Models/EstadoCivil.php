<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    use HasFactory;

    protected $table = 'tc_estado_civil';
    public $timestamps = true;

    protected $fillable = [
        'estado_civil',
    ];


}
