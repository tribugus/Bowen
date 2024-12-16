<?php



use Illuminate\Support\Facades\Route;
use App\Http\Middleware\loginMiddleware;
use App\Http\Middleware\logoutMiddleware;
use App\Http\Middleware\AuthorizedMiddleware;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DemoController;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\CicloEscolarController;
use App\Http\Controllers\NivelEducativoController;
use App\Http\Controllers\SerieMatriculaController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AlumnoController;




Route::get('test', [DemoController::class, 'index']);



Route::middleware(loginMiddleware::class)->group(function () {
    Route::get('login', [AccountController::class, 'login'])->name('login');
    Route::post('login', [AccountController::class, 'loginPost']);
});

Route::middleware(logoutMiddleware::class)->group(function () {

   
    Route::post('logout', [AccountController::class, 'logout']);
    Route::get('/', [HomeController::class, 'index']);



    Route::get('usuarios',[UsuariosController::class,'index'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('usuarios/crear', [UsuariosController::class, 'crear'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::post('usuarios/store', [UsuariosController::class, 'store'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('usuarios/edit/{id}', [UsuariosController::class, 'edit'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::put('usuarios/update', [UsuariosController::class, 'update'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::delete('usuarios/delete/{id}', [UsuariosController::class, 'delete'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('usuarios/inactivos',[UsuariosController::class,'inactivo'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::post('usuarios/active/{id}', [UsuariosController::class, 'active'])->middleware(AuthorizedMiddleware::class.':'.R1);



    Route::get('roles',[RollController::class,'index'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::get('roles/inactivos',[RollController::class,'inactivo'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::get('roles/crear', [RollController::class, 'crear'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::post('roles/store', [RollController::class, 'store'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::get('roles/edit/{id}', [RollController::class, 'edit'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::put('roles/update', [RollController::class, 'update'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::delete('roles/delete/{id}', [RollController::class, 'delete'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::post('roles/active/{id}', [RollController::class, 'active'])->middleware(AuthorizedMiddleware::class.':'.R1);



    Route::get('ciclo-escolar',[CicloEscolarController::class,'index'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('ciclo-escolar/crear',[CicloEscolarController::class,'crear'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::post('ciclo-escolar/store', [CicloEscolarController::class, 'store'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('ciclo-escolar/edit/{id}', [CicloEscolarController::class, 'edit'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::put('ciclo-escolar/update', [CicloEscolarController::class, 'update'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::delete('ciclo-escolar/delete/{id}', [CicloEscolarController::class, 'delete'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('ciclo-escolar/inactivos',[CicloEscolarController::class,'inactivo'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::post('ciclo-escolar/active/{id}', [CicloEscolarController::class, 'active'])->middleware(AuthorizedMiddleware::class.':'.R1);



    Route::get('nivel-educativo',[NivelEducativoController::class,'index'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('nivel-educativo/crear',[NivelEducativoController::class,'crear'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::post('nivel-educativo/store', [NivelEducativoController::class, 'store'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('nivel-educativo/edit/{id}', [NivelEducativoController::class, 'edit'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::put('nivel-educativo/update', [NivelEducativoController::class, 'update'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::delete('nivel-educativo/delete/{id}', [NivelEducativoController::class, 'delete'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('nivel-educativo/inactivos',[NivelEducativoController::class,'inactivo'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::post('nivel-educativo/active/{id}', [NivelEducativoController::class, 'active'])->middleware(AuthorizedMiddleware::class.':'.R1);



    Route::get('serie-matricula',[SerieMatriculaController::class,'index'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('serie-matricula/crear',[SerieMatriculaController::class,'crear'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::post('serie-matricula/store', [SerieMatriculaController::class, 'store'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('serie-matricula/edit/{id}', [SerieMatriculaController::class, 'edit'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::put('serie-matricula/update', [SerieMatriculaController::class, 'update'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::delete('serie-matricula/delete/{id}', [SerieMatriculaController::class, 'delete'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('serie-matricula/inactivos',[SerieMatriculaController::class,'inactivo'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::post('serie-matricula/active/{id}', [SerieMatriculaController::class, 'active'])->middleware(AuthorizedMiddleware::class.':'.R1);




    Route::get('profesores',[ProfesorController::class,'index'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('profesores/crear',[ProfesorController::class,'crear'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::post('profesores/store', [ProfesorController::class, 'store'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('profesores/edit/{id}', [ProfesorController::class, 'edit'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::put('profesores/update', [ProfesorController::class, 'update'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::delete('profesores/delete/{id}', [ProfesorController::class, 'delete'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('profesores/inactivos',[ProfesorController::class,'inactivo'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::post('profesores/active/{id}', [ProfesorController::class, 'active'])->middleware(AuthorizedMiddleware::class.':'.R1);



    Route::get('alumnos',[AlumnoController::class,'index'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('alumnos/crear',[AlumnoController::class,'crear'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::post('alumnos/store', [AlumnoController::class, 'store'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    /*Route::get('alumnos/edit/{id}', [AlumnoController::class, 'edit'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::put('alumnos/update', [AlumnoController::class, 'update'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::delete('alumnos/delete/{id}', [AlumnoController::class, 'delete'])->middleware(AuthorizedMiddleware::class.':'.R1.R2);
    Route::get('alumnos/inactivos',[AlumnoController::class,'inactivo'])->middleware(AuthorizedMiddleware::class.':'.R1);
    Route::post('alumnos/active/{id}', [AlumnoController::class, 'active'])->middleware(AuthorizedMiddleware::class.':'.R1);*/








});











/*
Route::get('test2', [DemoController::class, 'testSession'])->middleware(AuthorizedMiddleware::class.':1');
Route::middleware('auth')->group(function() {

    Route::get('test', function(Request $request) {

        $role_id = $request->session()->get('usuario')->roll->id;

        if ($role_id == 1) {
            return app(DemoController::class)->testSession();
        }
        return redirect()->route('/');

    });
});


#Home
include('web/home.php');

#Teachers
include('web/teachers.php');

#Students
include('web/students.php');

#Classrooms
include('web/classrooms.php');

#Subjects
include('web/subjects.php');

#Grades
include('web/grades.php');

#Enrollments
include('web/enrollments.php');

#Roles
include('web/roles.php');

#Users
include('web/users.php');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
