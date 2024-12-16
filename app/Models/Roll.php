<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    use HasFactory;

    protected $table = 'tc_roll';
    public $timestamps = true;

    protected $fillable = [
        'roll',
        'activo',
        'hash',
    ];


    public function usuarios()
    {
        return $this->hasMany(Usuario::class,'roll_id','id');
        //return $this->belongsToMany(Usuario::class,'roll_id','id');
        //return $this->belongsToMany(Roll::class,'tw_usuario','roll_id','id');
    }




}
