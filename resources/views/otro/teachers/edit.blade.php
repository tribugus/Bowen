@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Entidades</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Profesores</a></li>
                <li class="breadcrumb-item active">Editar Profesor</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">Editar Profesor</h5>

                <form class="row g-3" action="{{ route('teachers.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input name="first_name" id="first_name" class="form-control" placeholder="Nombres" value="{{ $teacher->first_name }}">
                            <label for="first_name">Nombres</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="last_name" id="last_name" class="form-control" placeholder="Apellidos" value="{{ $teacher->last_name }}">
                            <label for="last_name">Apellidos</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="email" type="email" id="email" class="form-control" placeholder="Email"  aria-describedby="emailHelp" value="{{ $teacher->email }}">
                            <label for="email">Email</label>
                            <div id="emailHelp" class="form-text">No compartiremos tu email con nadie más.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" name="birthdate" id="birthdate" class="form-control" placeholder="Fecha de Nacimiento" value="{{ $teacher->birthdate }}">
                            <label for="birthdate">Fecha de Nacimiento</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="address" id="address" class="form-control" placeholder="Dirección" value="{{ $teacher->address }}">
                            <label for="address">Dirección</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="phone" id="phone" class="form-control" placeholder="Celular" value="{{ $teacher->phone }}">
                            <label for="phone">Celular</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('teachers.index')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>

        </div>

    </section>

@endsection