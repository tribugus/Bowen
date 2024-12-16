<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'tc_modulo';
    public $timestamps = true;

    protected $fillable = [
        'modulo'
    ];


}
