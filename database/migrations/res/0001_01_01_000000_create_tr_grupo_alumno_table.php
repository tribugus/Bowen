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
        Schema::create('tr_grupo_alumno', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maestro_usuario_id');
            $table->unsignedBigInteger('alumno_usuario_id');
            $table->unsignedBigInteger('clico_escolar_id');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_grupo_alumno');

    }
};
