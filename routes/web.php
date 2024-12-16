<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::get('/', function () {
    return response()->json(['message' => 'Ruta /api/test está funcionando correctamente']);
});