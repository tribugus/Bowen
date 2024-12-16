<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\AuthorizedMiddleware;
use Illuminate\Support\Facades\Route;






Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware(AuthorizedMiddleware::class);



Route::get('/home/classroom/{id}', [HomeController::class, 'classroom'])->name('home.classroom')                    
->middleware(AuthorizedMiddleware::class . ':1');




Route::get('/home/enrollment/{id}', [HomeController::class, 'enrollment'])
    ->name('home.enrollment')
    ->middleware(AuthorizedMiddleware::class . ':Matriculas.showEnrollments');


Route::get('/home/grade/{id}', [HomeController::class, 'grade'])
    ->name('home.grade')
    ->middleware(AuthorizedMiddleware::class . ':Notas.showGrades');


Route::get('/home/student/{id}', [HomeController::class, 'student'])
    ->name('home.student')                      
    ->middleware(AuthorizedMiddleware::class . ':Estudiantes.showStudents');

Route::get('/home/subject/{id}', [HomeController::class, 'subject'])
    ->name('home.subject')
    ->middleware(AuthorizedMiddleware::class . ':Asignaturas.showSubjects');

Route::get('/home/teacher/{id}', [HomeController::class, 'teacher'])
    ->name('home.teacher')
    ->middleware(AuthorizedMiddleware::class . ':Profesores.showTeachers');
