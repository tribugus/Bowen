@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Entidades</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('enrollments.index') }}">Matriculas</a></li>
                <li class="breadcrumb-item active">Nueva Matricula</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">Nueva Matricula</h5>

                <form class="row g-3" action="{{ route('enrollments.store')}}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="number" name="academic_year" id="academic_year" class="form-control" placeholder="Año Académico">
                            <label for="academic_year">Año Académico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="student_id">
                                <option selected value="0">Seleccione</option>
                                @foreach ($students as $student)                 
                                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                                @endforeach
                            </select>
                            <label for="student_id">Estudiante</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="subject_id">
                                <option selected value="0">Seleccione</option>
                                @foreach ($subjects as $subject)                 
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            <label for="subject_id">Asignatura</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('enrollments.index')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
        
    </section>

@endsection