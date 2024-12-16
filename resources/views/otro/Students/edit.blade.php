@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Entidades</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Estudiantes</a></li>
                <li class="breadcrumb-item active">Editar Estudiante</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">Editar Estudiante</h5>

                <form class="row g-3" action="{{ route('students.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input name="first_name" id="first_name" class="form-control" placeholder="Nombres" value="{{ $student->first_name }}">
                            <label for="first_name">Nombres</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="last_name" id="last_name" class="form-control" placeholder="Apellidos" value="{{ $student->last_name }}">
                            <label for="last_name">Apellidos</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="email" type="email" id="email" class="form-control" placeholder="Email"  aria-describedby="emailHelp" value="{{ $student->email }}">
                            <label for="email">Email</label>
                            <div id="emailHelp" class="form-text">No compartiremos tu email con nadie más.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Fecha de Nacimiento" value="{{ $student->date_of_birth }}">
                            <label for="date_of_birth">Fecha de Nacimiento</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="gender" id="gender" class="form-control" placeholder="Género" value="{{ $student->gender }}">
                            <label for="gender">Género</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="address" id="address" class="form-control" placeholder="Dirección" value="{{ $student->address }}">
                            <label for="address">Dirección</label>
                        </div>
                        <div class="form-floating">
                            <input name="phone_number" id="phone_number" class="form-control" placeholder="Celular" value="{{ $student->phone_number }}">
                            <label for="phone_number">Celular</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('students.index')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>

        </div>

    </section>

@endsection