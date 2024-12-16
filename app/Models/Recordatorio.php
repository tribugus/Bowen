<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si no sigue la convención plural
    protected $table = 'recordatorio';

    // Definir las columnas que pueden ser asignadas masivamente
    protected $fillable = [
        'tarea_id',           // Identificador de la tarea
        'fecha_recordatorio', // Fecha y hora del recordatorio
    ];

    // Si deseas ocultar ciertos atributos cuando se convierte el modelo a un arreglo o JSON, puedes definirlo aquí
    protected $hidden = [
        // Puedes agregar atributos a ocultar si lo deseas
    ];

    // Definir las relaciones si es necesario
    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }

    // Si necesitas que la fecha de creación o actualización esté en otro formato, puedes especificarlo aquí
    protected $dates = [
        'fecha_recordatorio', // Especificamos que `fecha_recordatorio` es un campo de tipo datetime
        'created_at',
        'updated_at',
    ];
}
