@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Editar {{ ucwords($rol->roll) }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('roles') }}">Roles</a></li>
                <li class="breadcrumb-item active">Editar {{ ucwords($rol->roll) }}</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card mb-4">
            <div class="card-body mw-100 w-px-800 m-md-auto">
                <h3 class="card-title">Editar {{ ucwords($rol->roll) }}</h3>

                <form class="row g-3" action="{{ url('roles/update') }}" method="POST" id="frmCreate">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="rol_id" value="{{ $rol->id }}">

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input name="rol" class="form-control" placeholder="Roll..." value="{{ $rol->roll }}"/>
                            <label>Rol</label>
                        </div>
                        @error('rol')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                

                </form>

            </div>

            <div class="card-footer mw-100 w-px-800 m-md-auto pt-0">
                <div class="btn-group w-100" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-primary" form="frmCreate">Guardar</button>
                  <a href="{{ url('roles') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>


        </div>



    </section>

@endsection