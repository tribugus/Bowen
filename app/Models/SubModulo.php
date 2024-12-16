<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubModulo extends Model
{
    use HasFactory;

    protected $table = 'tc_sub_modulo';
    public $timestamps = true;

    protected $fillable = [
        'sub_modulo',
        'modulo_id',
    ];


}
