<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneroUsuario extends Model
{
    use HasFactory;

    protected $table = 'tc_genero_usuario';
    public $timestamps = true;

    protected $fillable = [
        'genero',
    ];


}
