@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Entidades</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('subjects.index') }}">Asignaturas</a></li>
                <li class="breadcrumb-item active">Nueva Asignatura</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">Nueva Asignatura</h5>

                <form class="row g-3" action="{{ route('subjects.store')}}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input name="name" id="name" class="form-control" placeholder="Nombre">
                            <label for="name">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="grade_level" id="grade_level" class="form-control" placeholder="Grado">
                            <label for="grade_level">Grado</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="time" name="schedule" id="schedule" class="form-control" placeholder="Horario">
                            <label for="schedule">Horario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="teacher_id">
                                <option selected value="0">Seleccione</option>
                                @foreach ($teachers as $teacher)                 
                                    <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                                @endforeach
                            </select>
                            <label for="teacher_id">Profesor</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="classroom_id">
                                <option selected value="0">Seleccione</option>
                                @foreach ($classrooms as $classroom)                 
                                    <option value="{{ $classroom->id }}">{{ $classroom->code }}</option>
                                @endforeach
                            </select>
                            <label for="classroom_id">Aula</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('subjects.index')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
        
    </section>

@endsection