<?php


use Illuminate\Support\Facades\Route;

use App\Models\Usuario;

Route::get('/test', function () {

    $data = Usuario::all();

    return $data;
});