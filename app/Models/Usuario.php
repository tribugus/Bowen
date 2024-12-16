<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Usuario extends Authenticatable
{


    protected $table = 'tw_usuario'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = ['activo','telefono','roll_id','nombre','ap_pat','ap_mat','correo','contrasena'];  // Asegúrate de que los campos estén en $fillable

    protected $hidden = ['contrasena'];  // Ocultar la contraseña al serializar el modelo

    // Personaliza el nombre del campo 'correo' si no es 'email'
    public function getAuthIdentifierName()
    {
        return 'correo';
    }

    // Personaliza el campo 'contrasena' si no es 'password'
    public function getAuthPassword()
    {
        return $this->contrasena;
    }


    public function roll()
    {
        return $this->hasOne(Roll::class,'id','roll_id');
    }

    public function profesor()
    {
        return $this->hasOne(Profesor::class,'usuario_id','id');
    }




}
