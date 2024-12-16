<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea', function (Blueprint $table) {
            $table->id();  // Identificador único de la tarea, auto incremento
            $table->unsignedBigInteger('usuario_id');  // Relación con el usuario (si usas un sistema de usuarios)
            $table->string('titulo');  // Título de la tarea
            $table->text('descripcion')->nullable();  // Descripción de la tarea (opcional)
            $table->dateTime('fecha_inicio')->nullable();  // Fecha de inicio de la tarea
            $table->dateTime('fecha_vencimiento')->nullable();  // Fecha de vencimiento de la tarea
            $table->string('prioridad', 10)->default('Media');  // Prioridad de la tarea (como string)
            $table->string('estado', 15)->default('Pendiente');  // Estado de la tarea (como string)
            $table->timestamps();  // Agrega created_at y updated_at
        });
    }

    /**
     * Deshacer la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarea');
    }
}
