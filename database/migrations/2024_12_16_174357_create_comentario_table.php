<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario', function (Blueprint $table) {
            $table->id();  // Identificador único del comentario, auto incremento
            $table->unsignedBigInteger('tarea_id');  // Identificador de la tarea
            $table->unsignedBigInteger('usuario_id');  // Identificador del usuario que dejó el comentario
            $table->text('contenido');  // Contenido del comentario
            $table->dateTime('fecha_creacion')->default(DB::raw('CURRENT_TIMESTAMP'));  // Fecha de creación del comentario
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
        Schema::dropIfExists('comentario');  // El nombre de la tabla en singular
    }
}
