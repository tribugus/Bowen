<?php
use App\Http\Controllers\EnrollmentsController;
use App\Http\Middleware\AuthorizedMiddleware;

Route::get('/enrollments', [EnrollmentsController::class, 'index'])
    ->name('enrollments.index')
    ->middleware(AuthorizedMiddleware::class . ':Matriculas.showEnrollments');
    
Route::get('/enrollments/create', [EnrollmentsController::class, 'create'])
    ->name('enrollments.create')
    ->middleware(AuthorizedMiddleware::class . ':Matriculas.createEnrollments');

Route::get('/enrollments/edit/{id}', [EnrollmentsController::class, 'edit'])
    ->name('enrollments.edit')
    ->middleware(AuthorizedMiddleware::class . ':Matriculas.updateEnrollments');

Route::get('/enrollments/getEnrollmentData/{id}', [EnrollmentsController::class, 'getEnrollmentData'])->name('enrollments.getEnrollmentData');

Route::post('/enrollments/store', [EnrollmentsController::class, 'store'])
    ->name('enrollments.store')
    ->middleware(AuthorizedMiddleware::class . ':Matriculas.createEnrollments');

Route::put('/enrollments/update', [EnrollmentsController::class, 'update'])
    ->name('enrollments.update')
    ->middleware(AuthorizedMiddleware::class . ':Matriculas.updateEnrollments');

Route::delete('/enrollments/delete/{id}', [EnrollmentsController::class, 'delete'])
    ->name('enrollments.delete')
    ->middleware(AuthorizedMiddleware::class . ':Matriculas.deleteEnrollments');
