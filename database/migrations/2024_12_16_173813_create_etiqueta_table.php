<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtiquetaTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiqueta', function (Blueprint $table) {
            $table->id();  // Identificador único de la etiqueta, auto incremento
            $table->string('nombre');  // Nombre de la etiqueta
            $table->unsignedBigInteger('usuario_id');  // Identificador del usuario que creó la etiqueta
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
        Schema::dropIfExists('etiqueta');  // El nombre de la tabla en singular
    }
}
