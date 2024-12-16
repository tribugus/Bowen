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
        Schema::create('tw_alumno', function (Blueprint $table) {


            $table->id();

            $table->string('genero');
            $table->string('date_nacimiento');
            $table->date('fecha_nacimiento');
            $table->unsignedBigInteger('nivel_educativo_id');
            $table->integer('grado');
            $table->unsignedBigInteger('grupo_id');
            $table->unsignedBigInteger('matricula_id');
            $table->integer('consecutivo_matricula');
            $table->string('matricula_interna');
            $table->string('matricula_oficial');
            $table->string('lugar_nacimiento');
            $table->string('nacionalidad');
            $table->string('estado_civil');
            $table->string('date_ingreso');
            $table->date('fecha_ingreso');
            $table->date('ciclo_escolar_id');
            $table->date('curp');
            $table->date('usuario_id');
            
            $table->timestamps();


        });
    }

    /**php artisan migrate --path=/database/migrations/2024_12_12_194021_create_tw_alumno_table.php
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tw_alumno');
    }
};



