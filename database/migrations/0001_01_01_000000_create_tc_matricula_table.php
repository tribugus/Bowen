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
        Schema::create('tc_matricula', function (Blueprint $table) {
            $table->id();
            $table->string('formato');
            $table->boolean('activo');
            $table->integer('ini_matricula');
            $table->integer('consecutivo_matricula');
            $table->integer('limite_matricula');
            $table->boolean('permitir_modificar');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_matricula');

    }
};