<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    use HasFactory;

    protected $table = 'tc_mes';
    public $timestamps = true;

    protected $fillable = [
        'mes',
    ];


}
