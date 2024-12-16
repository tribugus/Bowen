<?php
use App\Http\Controllers\SubjectsController;
use App\Http\Middleware\AuthorizedMiddleware;

Route::get('/subjects', [SubjectsController::class, 'index'])
    ->name('subjects.index')
    ->middleware(AuthorizedMiddleware::class . ':Asignaturas.showSubjects');
    
Route::get('/subjects/create', [SubjectsController::class, 'create'])
    ->name('subjects.create')
    ->middleware(AuthorizedMiddleware::class . ':Asignaturas.createSubjects');

Route::get('/subjects/edit/{id}', [SubjectsController::class, 'edit'])
    ->name('subjects.edit')
    ->middleware(AuthorizedMiddleware::class . ':Asignaturas.updateSubjects');


Route::post('/subjects/store', [SubjectsController::class, 'store'])
    ->name('subjects.store')
    ->middleware(AuthorizedMiddleware::class . ':Asignaturas.createSubjects');

Route::put('/subjects/update', [SubjectsController::class, 'update'])
    ->name('subjects.update')
    ->middleware(AuthorizedMiddleware::class . ':Asignaturas.updateSubjects');

Route::delete('/subjects/delete/{id}', [SubjectsController::class, 'delete'])
    ->name('subjects.delete')
    ->middleware(AuthorizedMiddleware::class . ':Asignaturas.deleteSubjects');
