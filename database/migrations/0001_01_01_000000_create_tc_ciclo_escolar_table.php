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
        Schema::create('tc_ciclo_escolar', function (Blueprint $table) {
            $table->id();
            $table->year('ano_ini');
            $table->year('ano_fin');
            $table->integer('periodo');
            $table->string('descripcion',250);
            $table->string('denominacion');
            $table->string('abreviatura');
            $table->string('codigo',20);
            $table->string('date_ini',20);
            $table->string('date_fin',20);
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->boolean('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_ciclo_escolar');

    }
};
