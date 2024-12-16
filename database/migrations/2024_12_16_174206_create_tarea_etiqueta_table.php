<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaEtiquetaTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea_etiqueta', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('tarea_id');  // Identificador de la tarea
            $table->unsignedBigInteger('etiqueta_id');  // Identificador de la etiqueta
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
        Schema::dropIfExists('tarea_etiqueta');  // El nombre de la tabla en singular
    }
}
