<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tc_nivel_educativo', function (Blueprint $table) {
            $table->id();
            $table->string('clave_identificador');
            $table->string('descripcion');
            $table->unsignedBigInteger('director_usuario_id');
            $table->string('acuerdo_creacion_incorporacion');
            $table->string('date');
            $table->date('fecha_incorporacion');
            $table->integer('zona_escolar');
            $table->string('denominacion_grado');
            $table->integer('grado_ini');
            $table->integer('grado_fin');
            $table->unsignedBigInteger('matricula_id');
            $table->boolean('activo');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_nivel_educativo');

    }
};
