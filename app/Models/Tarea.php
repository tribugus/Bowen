<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si no sigue la convención plural
    protected $table = 'tarea';

    // Definir las columnas que pueden ser asignadas masivamente
    protected $fillable = [
        'usuario_id',    // Identificador del usuario que creó la tarea
        'titulo',        // Título de la tarea
        'descripcion',   // Descripción de la tarea (opcional)
        'fecha_inicio',  // Fecha de inicio de la tarea
        'fecha_vencimiento', // Fecha de vencimiento de la tarea
        'prioridad',     // Prioridad de la tarea
        'estado',        // Estado de la tarea
    ];

    // Si deseas ocultar ciertos atributos cuando se convierte el modelo a un arreglo o JSON, puedes definirlo aquí
    protected $hidden = [
        // Puedes agregar atributos a ocultar si lo deseas
    ];

    // Definir las relaciones si es necesario, por ejemplo, la relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Si necesitas que la fecha de creación o actualización esté en otro formato, puedes especificarlo aquí
    protected $dates = [
        'created_at',
        'updated_at',
        'fecha_inicio',
        'fecha_vencimiento',
    ];
}
