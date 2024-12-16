@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Módulos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Home</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">

    @if(\App\Helpers\RoleHelper::isAuthorized('Aulas.showClassrooms'))
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="card-title">Aulas</h3>
                <div class="row">
                @foreach ($classrooms as $classroom)
                    <div class="col-md-5 m-2">
                        <a href="{{ route('home.classroom', $classroom->id) }}" class="btn btn-outline-primary form-control">{{ $classroom->code }}</a>
                    </div>
                @endforeach
                </div>             
            </div>
        </div>
    @endif

    @if(\App\Helpers\RoleHelper::isAuthorized('Matriculas.showEnrollments'))
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="card-title">Matriculas</h3>
                <div class="row">
                @foreach ($enrollments as $enrollment)
                    <div class="col-md-5 m-2">
                        @foreach ($subjects as $subject)
                            @foreach ($students as $student)
                                @if ($subject->id == $enrollment->subject_id && $student->id == $enrollment->student_id)
                                    <a href="{{ route('home.enrollment', $enrollment->id) }}" class="btn btn-outline-primary form-control">{{ $subject->name }} - {{ $student->first_name }} {{ $student->last_name }}</a>
                                @endif   
                            @endforeach            
                        @endforeach         
                    </div>
                @endforeach
                </div>             
            </div>
        </div>
    @endif

    @if(\App\Helpers\RoleHelper::isAuthorized('Notas.showGrades') && !\App\Helpers\RoleHelper::isAuthorized('Notas.updateGrades'))
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="card-title">Notas</h3>
                <div class="row">
                @foreach ($enrollments as $enrollment)
                    <div class="col-md-5 m-2">
                        @foreach ($subjects as $subject)
                            @if ($subject->id == $enrollment->subject_id)
                                <a href="{{ route('home.grade', $enrollment->id) }}" class="btn btn-outline-primary form-control">{{ $subject->name }}</a>   
                            @endif        
                        @endforeach 
                    </div>
                @endforeach
                </div>             
            </div>
        </div>   
    @endif

    @if(\App\Helpers\RoleHelper::isAuthorized('Notas.updateGrades'))
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="card-title">Notas</h3>
                <div class="row">
                    @foreach ($enrollments as $enrollment)
                        <div class="col-md-5 m-2">
                            @foreach ($subjects as $subject)
                                @foreach ($students as $student)
                                    @if ($subject->id == $enrollment->subject_id && $student->id == $enrollment->student_id)
                                        <a href="{{ route('home.grade', $enrollment->id) }}" class="btn btn-outline-primary form-control">{{ $subject->name }}  - {{ $student->first_name }} {{ $student->last_name }}</a>   
                                    @endif     
                                @endforeach   
                            @endforeach 
                        </div>
                    @endforeach
                </div>             
            </div>
        </div>   
    @endif

    @if(\App\Helpers\RoleHelper::isAuthorized('Estudiantes.showStudents'))
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="card-title">Estudiantes</h3>
                <div class="row">
                @foreach ($students as $student)
                    <div class="col-md-5 m-2">
                        <a href="{{ route('home.student', $student->id) }}" class="btn btn-outline-primary form-control">{{ $student->first_name }} {{ $student->last_name }}</a>
                    </div>
                @endforeach
                </div>             
            </div>
        </div>
    @endif

    @if(\App\Helpers\RoleHelper::isAuthorized('Profesores.showTeachers'))
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="card-title">Profesores</h3>
                <div class="row">
                @foreach ($teachers as $teacher)
                    <div class="col-md-5 m-2">
                        <a href="{{ route('home.teacher', $teacher->id) }}" class="btn btn-outline-primary form-control">{{ $teacher->first_name }} {{ $teacher->last_name }}</a>
                    </div>
                @endforeach
                </div>             
            </div>
        </div>
    @endif

    @if(\App\Helpers\RoleHelper::isAuthorized('Asignaturas.showSubjects'))
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="card-title">Asignaturas</h3>
                <div class="row">
                @foreach ($subjects as $subject)
                    <div class="col-md-5 m-2">
                        <a href="{{ route('home.subject', $subject->id) }}" class="btn btn-outline-primary form-control">{{ $subject->name }}</a>
                    </div>
                @endforeach
                </div>             
            </div>
        </div>
    @endif
</section>

@endsection