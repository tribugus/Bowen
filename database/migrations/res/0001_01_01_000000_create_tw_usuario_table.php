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
        Schema::create('tw_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('ap_pat');
            $table->string('ap_mat');
            $table->string('nombre');
            $table->string('correo')->unique();
            $table->string('contrasena');
            $table->unsignedBigInteger('roll_id');
            $table->string('telefono');
            $table->timestamp('fecha_registro');
            $table->boolean('activo');
            $table->rememberToken();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tw_usuario');

    }
};
