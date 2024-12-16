@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Entidades</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('enrollments.index') }}">Matriculas</a></li>
                <li class="breadcrumb-item active">Editar Matricula</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">Editar Matriculas</h5>

                <form class="row g-3" action="{{ route('enrollments.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="enrollment_id" value="{{ $enrollment->id }}">
                    <div class="col-md-12">
                    <div class="form-floating mb-3">
                            <input type="number" name="academic_year" id="academic_year" class="form-control" placeholder="Año Académico" value="{{ $enrollment->academic_year }}">
                            <label for="academic_year">Año Académico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="student_id">
                                <option selected value="{{ $studentSelected->id }}">{{ $studentSelected->first_name }} {{ $studentSelected->last_name }}</option>
                                @foreach ($students as $student)
                                    @if ($studentSelected->id != $student->id)                
                                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="student_id">Estudiante</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="subject_id">
                                <option selected value="{{ $subjectSelected->id }}">{{ $subjectSelected->name }}</option>
                                @foreach ($subjects as $subject) 
                                    @if ($subjectSelected->id != $subject->id)                
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endif                
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