@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Editando a {{ ucwords($user->nombre) }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('usuarios') }}">Usuarios</a></li>
                <li class="breadcrumb-item active">Editando Usuario</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card mb-4">
            <div class="card-body mw-100 w-px-800 m-md-auto">
                <h3 class="card-title">Usuario {{ ucwords($user->nombre) }}</h3>

                <form class="row g-3" action="{{ url('usuarios/update') }}" method="POST" id="frmCreate">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="usuario_id" value="{{ $user->id }}">


                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="nombre" class="form-control" placeholder="Nombre..." value="{{ $user->nombre }}"/>
                            <label>Nombres</label>
                        </div>
                        @error('nombre')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="ap_pat" class="form-control" placeholder="Apellido paterno..." value="{{ $user->ap_pat }}"/>
                            <label>Apellido paterno</label>
                        </div>
                        @error('ap_pat')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="ap_mat" class="form-control" placeholder="Apellido materno..." value="{{ $user->ap_mat }}"/>
                            <label>Apellido materno</label>
                        </div>
                        @error('ap_mat')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="correo" type="email" class="form-control" placeholder="Email..." value="{{ $user->correo }}"/>
                            <label>Email</label>
                        </div>
                        @error('correo')
                            <div class="error">{{ $message }}</div>
                        @enderror       
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="telefono" type="number" class="form-control" placeholder="Teléfono..." value="{{ $user->telefono }}"/>
                            <label>Teléfono</label>
                        </div>
                        @error('telefono')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" name="roll_id">
                                <option value="">Seleccionar opción</option>
                                @foreach ($roles as $roll)
                                    @if($user->roll_id == $roll->id)
                                    <option value="{{ $roll->id }}" selected>{{ mb_strtoupper($roll->roll) }}</option>
                                    @else
                                    <option value="{{ $roll->id }}" >{{ mb_strtoupper($roll->roll) }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label>Roll</label>
                        </div>
                        @error('roll_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="contrasena" type="password" class="form-control" placeholder="Contraseña..." >
                            <label>Contraseña</label>
                        </div>
                        @error('contrasena')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="contrasena_confirmation" type="password" class="form-control" placeholder="Repetir contraseña..." >
                            <label>Repetir contraseña</label>
                        </div>
                        @error('contrasena_confirmation')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                </form>

            </div>
     

            <div class="card-footer mw-100 w-px-800 m-md-auto pt-0">
                <div class="btn-group w-100" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-primary" form="frmCreate">Guardar</button>
                  <a href="{{ url('usuarios') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>



        </div>



    </section>

@endsection