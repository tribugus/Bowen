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
        /*Schema::create('tw_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('document');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
        });*/


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




        /*Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });*/

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tw_usuario');
        //Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};