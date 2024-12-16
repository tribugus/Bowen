<?php
use App\Http\Controllers\StudentsController;
use App\Http\Middleware\AuthorizedMiddleware;

Route::get('/students', [StudentsController::class, 'index'])
    ->name('students.index')
    ->middleware(AuthorizedMiddleware::class . ':Estudiantes.showStudents');

Route::get('/students/create', [StudentsController::class, 'create'])
    ->name('students.create')
    ->middleware(AuthorizedMiddleware::class . ':Estudiantes.createStudents');

Route::get('/students/edit/{id}', [StudentsController::class, 'edit'])
    ->name('students.edit')
    ->middleware(AuthorizedMiddleware::class . ':Estudiantes.updateStudents');

Route::post('/students/store', [StudentsController::class, 'store'])
    ->name('students.store')
    ->middleware(AuthorizedMiddleware::class . ':Estudiantes.createStudents');

Route::put('/students/update', [StudentsController::class, 'update'])
    ->name('students.update')
    ->middleware(AuthorizedMiddleware::class . ':Estudiantes.updateStudents');

Route::delete('/students/delete/{id}', [StudentsController::class, 'delete'])
    ->name('students.delete')
    ->middleware(AuthorizedMiddleware::class . ':Estudiantes.deleteStudents');
