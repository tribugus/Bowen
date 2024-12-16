<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordatorioTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordatorio', function (Blueprint $table) {
            $table->id();  // Identificador único del recordatorio, auto incremento
            $table->unsignedBigInteger('tarea_id');  // Identificador de la tarea
            $table->dateTime('fecha_recordatorio');  // Fecha y hora del recordatorio
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
        Schema::dropIfExists('recordatorio');  // El nombre de la tabla en singular
    }
}
