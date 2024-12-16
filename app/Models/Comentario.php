<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si no sigue la convención plural
    protected $table = 'comentario';

    // Definir las columnas que pueden ser asignadas masivamente
    protected $fillable = [
        'tarea_id',    // Identificador de la tarea
        'usuario_id',  // Identificador del usuario que dejó el comentario
        'contenido',   // Contenido del comentario
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

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Si necesitas que la fecha de creación o actualización esté en otro formato, puedes especificarlo aquí
    protected $dates = [
        'fecha_creacion',
        'created_at',
        'updated_at',
    ];

    // Si no quieres que se establezca un valor por defecto de la fecha
    protected $casts = [
        'fecha_creacion' => 'datetime',
    ];
}
