<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si no sigue la convención plural (por defecto se espera 'usuarios')
    protected $table = 'usuario';

    // Definir las columnas que pueden ser asignadas masivamente
    protected $fillable = [
        'nikname',    // Apodo del usuario
        'email',      // Correo electrónico del usuario
        'password',   // Contraseña del usuario
    ];

    // Si deseas ocultar ciertos atributos cuando se convierte el modelo a un arreglo o JSON, puedes definirlo aquí
    protected $hidden = [
        'password',   // Ocultar la contraseña por razones de seguridad
        'remember_token', // Ocultar el token de "recordarme"
    ];

    // Si necesitas que la fecha de creación o actualización esté en otro formato, puedes especificarlo aquí
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
