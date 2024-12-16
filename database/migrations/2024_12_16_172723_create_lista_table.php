<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista', function (Blueprint $table) {
            $table->id();  // Identificador único de la lista, auto incremento
            $table->unsignedBigInteger('usuario_id');  // Relación con el usuario (si usas un sistema de usuarios)
            $table->string('nombre');  // Nombre de la lista
            $table->text('descripcion')->nullable();  // Descripción de la lista (opcional)
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
        Schema::dropIfExists('lista');  // El nombre de la tabla en singular
    }
}
