<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'tc_materia';
    public $timestamps = true;

    protected $fillable = [
        'materia',
    ];


}
