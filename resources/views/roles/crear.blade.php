@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Nuevo Rol</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('roles') }}">Roles</a></li>
                <li class="breadcrumb-item active">Nuevo Rol</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card mb-4">
            <div class="card-body mw-100 w-px-800 m-md-auto">
                <h3 class="card-title">Nuevo Rol</h3>

                <form class="row g-3" action="{{ url('roles/store') }}" method="POST" id="frmCreate">
                    @csrf



                    <div class="col-md-12">
                        <div class="form-floating">
                            <input name="rol" class="form-control" placeholder="Roll..." value="{{ old('roll') }}"/>
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