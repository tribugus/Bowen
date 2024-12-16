<?php
use App\Http\Controllers\ClassroomsController;
use App\Http\Middleware\AuthorizedMiddleware;

Route::get('/classrooms', [ClassroomsController::class, 'index'])
    ->name('classrooms.index')
    ->middleware(AuthorizedMiddleware::class . ':Aulas.showClassrooms');

Route::get('/classrooms/create', [ClassroomsController::class, 'create'])
    ->name('classrooms.create')
    ->middleware(AuthorizedMiddleware::class . ':Aulas.createClassrooms');

Route::get('/classrooms/edit/{id}', [ClassroomsController::class, 'edit'])
    ->name('classrooms.edit')
    ->middleware(AuthorizedMiddleware::class . ':Aulas.updateClassrooms');

Route::post('/classrooms/store', [ClassroomsController::class, 'store'])
    ->name('classrooms.store')
    ->middleware(AuthorizedMiddleware::class . ':Aulas.createClassrooms');

Route::put('/classrooms/update', [ClassroomsController::class, 'update'])
    ->name('classrooms.update')
    ->middleware(AuthorizedMiddleware::class . ':Aulas.updateClassrooms');
    
Route::delete('/classrooms/delete/{id}', [ClassroomsController::class, 'delete'])
    ->name('classrooms.delete')
    ->middleware(AuthorizedMiddleware::class . ':Aulas.deleteClassrooms');
