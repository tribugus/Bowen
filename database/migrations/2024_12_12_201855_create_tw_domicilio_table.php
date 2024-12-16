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
        Schema::create('tw_domicilio', function (Blueprint $table) {
            $table->id();

            $table->string('descripcion');
            $table->string('domicilio_particular');
            $table->string('entre_calles');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('codigo_postal');
            $table->string('telefono');
            $table->string('usuario_id');

            $table->timestamps();

        });
    }

    /**php artisan migrate --path=/database/migrations/2024_12_12_201855_create_tw_domicilio_table.php
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tw_domicilio');
    }
};


