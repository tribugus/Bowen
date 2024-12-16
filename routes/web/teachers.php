<?php
use App\Http\Controllers\TeachersController;
use App\Http\Middleware\AuthorizedMiddleware;

Route::get('/teachers',[TeachersController::class, 'index'])
    ->name('teachers.index')
    ->middleware(AuthorizedMiddleware::class . ':Profesores.showTeachers');

Route::get('/teachers/create',[TeachersController::class, 'create'])
    ->name('teachers.create')
    ->middleware(AuthorizedMiddleware::class . ':Profesores.createTeachers');

Route::get('/teachers/edit/{id}', [TeachersController::class, 'edit'])
    ->name('teachers.edit')
    ->middleware(AuthorizedMiddleware::class . ':Profesores.updateTeachers');

Route::post('/teachers/store',[TeachersController::class, 'store'])
    ->name('teachers.store')
    ->middleware(AuthorizedMiddleware::class . ':Profesores.createTeachers');

Route::put('/teachers/update',[TeachersController::class, 'update'])
    ->name('teachers.update')
    ->middleware(AuthorizedMiddleware::class . ':Profesores.updateTeachers');

Route::delete('/teachers/delete/{id}',[TeachersController::class, 'delete'])
    ->name('teachers.delete')
    ->middleware(AuthorizedMiddleware::class . ':Profesores.deleteTeachers');