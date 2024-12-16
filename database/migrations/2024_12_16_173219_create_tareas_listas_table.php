<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasListasTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_listas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarea_id');  // Identificador de la tarea
            $table->unsignedBigInteger('lista_id');  // Identificador de la lista
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
        Schema::dropIfExists('tareas_listas');  // El nombre de la tabla en plural
    }
}
