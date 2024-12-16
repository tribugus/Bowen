<?php
use App\Http\Controllers\GradesController;
use App\Http\Middleware\AuthorizedMiddleware;

Route::get('/grades', [GradesController::class, 'index'])
    ->name('grades.index')
    ->middleware(AuthorizedMiddleware::class . ':Notas.showGrades');

Route::get('/grades/create', [GradesController::class, 'create'])
    ->name('grades.create')
    ->middleware(AuthorizedMiddleware::class . ':Notas.createGrades');

Route::get('/grades/edit/{id}', [GradesController::class, 'edit'])
    ->name('grades.edit')
    ->middleware(AuthorizedMiddleware::class . ':Notas.updateGrades');

Route::post('/grades/store', [GradesController::class, 'store'])
    ->name('grades.store')
    ->middleware(AuthorizedMiddleware::class . ':Notas.createGrades');

Route::put('/grades/update', [GradesController::class, 'update'])
    ->name('grades.update')
    ->middleware(AuthorizedMiddleware::class . ':Notas.updateGrades');

Route::delete('/grades/delete/{id}', [GradesController::class, 'delete'])
    ->name('grades.delete')
    ->middleware(AuthorizedMiddleware::class . ':Notas.deleteGrades');