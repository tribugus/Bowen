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
        Schema::create('tw_profesor', function (Blueprint $table) {
            $table->id();
            $table->string('clave_profesor');
            $table->unsignedBigInteger('genero_usuario_id');
            $table->string('date');
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento');
            $table->unsignedBigInteger('estado_civil_id');
            $table->string('curp');
            $table->string('no_seguro_social');
            $table->string('cedula_fiscal_rfc');
            $table->unsignedBigInteger('usuario_id');
            $table->boolean('activo');
            $table->timestamps();
        });

    }

    /**php artisan migrate --path=/database/migrations/2024_12_10_211212_create_tw_profesor_table.php
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tw_profesor');
    }
};
