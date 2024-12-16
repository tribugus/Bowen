




@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Nuevo Alumno</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('alumnos') }}">Profesores</a></li>
                <li class="breadcrumb-item active">Nuevo Alumno</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card mb-4">
            <div class="card-body mw-100 w-px-800 m-md-auto">

                <h3 class="card-title">Nuevo Alumno</h3>

                <form class="row g-3" action="{{ url('alumnos/store') }}" 
                      method="POST" id="frmCreate">
                      @csrf



                    <div class="col-md-4">
                        <div class="form-floating">
                            <input name="nombre" class="form-control" placeholder="Nombre..." value="{{ old('nombre') }}"/>
                            <label>Nombres</label>
                        </div>
                        @error('nombre')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input name="ap_pat" class="form-control" placeholder="Apellido paterno..." value="{{ old('ap_pat') }}"/>
                            <label>Apellido paterno</label>
                        </div>
                        @error('ap_pat')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input name="ap_mat" class="form-control" placeholder="Apellido materno..." value="{{ old('ap_mat') }}"/>
                            <label>Apellido materno</label>
                        </div>
                        @error('ap_mat')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="correo" type="email" class="form-control" placeholder="Email..." value="{{ old('correo') }}"/>
                            <label>Email</label>
                        </div>
                        @error('correo')
                            <div class="error">{{ $message }}</div>
                        @enderror       
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="telefono" type="number" class="form-control" placeholder="Teléfono..." value="{{ old('telefono') }}"/>
                            <label>Teléfono</label>
                        </div>
                        @error('telefono')
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


                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input name="contrasena_confirmation" type="password" class="form-control"
                                   placeholder="Repetir contraseña..." >
                            <label>Repetir contraseña</label>
                        </div>
                        @error('contrasena_confirmation')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>



                    <h3 class="card-title mb-1">Datos Alumno</h3>



                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" name="genero">
                                <option value="">Seleccionar opción</option>
                                @foreach($gu as $v)
                                <option value="{{ $v->id }}">{{  $v->genero  }}</option>
                                @endforeach
                            </select>
                            <label>Género</label>
                        </div>
                        @error('genero')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input name="fecha_nacimiento" id="selector" class="form-control" placeholder="Fecha de nacimiento..." 
                                   value="{{ old('fecha_nacimiento') }}"/>

                            <label>Fecha de nacimiento</label>
                        </div>
                        @error('fecha_nacimiento')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" name="nacionalidad_id">
                                <option value="">Seleccionar opción</option>
                                @foreach($nacionalidades as $v)
                                <option value="{{ $v->id }}">{{ $v->nacionalidad }}</option>
                                @endforeach
                            </select>
                            <label>Nacionalidad</label>
                        </div>
                        @error('nacionalidad_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="lugar_nacimiento" class="form-control" 
                                   placeholder="Lugar de nacimiento..." value="{{ old('lugar_nacimiento') }}"/>
                            <label>Lugar de nacimiento</label>
                        </div>
                        @error('lugar_nacimiento')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" name="nivel_educativo_id" @if(1>count($nv_edu)) disabled @endif >
                                <option value="">Seleccionar opción</option>
                                @foreach($nv_edu as $k => $v)
                                <option value="{{ $v->id }}">{{ $v->descripcion }}</option>
                                @endforeach
                            </select>
                            <label>Nivel educativo</label>
                        </div>
                        @error('nivel_educativo_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input name="fecha_ingreso" id="selector" class="form-control" placeholder="Fecha de ingreso..." 
                                   value="{{ old('fecha_ingreso') }}"/>

                            <label>Fecha de ingreso</label>
                        </div>
                        @error('fecha_ingreso')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" name="ciclo_escolar_id" @if(1>count($ciclo)) disabled @endif >
                                <option value="">Seleccionar opción</option>
                                @foreach($ciclo as $k => $v)
                                <option value="{{ $v->id }}">{{ $v->descripcion }}</option>
                                @endforeach
                            </select>
                            <label>Ciclo escolar</label>
                        </div>
                        @error('ciclo_escolar_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="curp" class="form-control" 
                                   placeholder="CURP..." value="{{ old('curp') }}"/>
                            <label>CURP</label>
                        </div>
                        @error('curp')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    





                    <h3 class="card-title mb-1">Datos domicilarios</h3>


 



                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" name="estado" @if(1>count($estados)) disabled @endif >
                                <option value="">Seleccionar opción</option>
                                @foreach($estados as $k => $v)
                                <option value="{{ $v->id }}">{{ $v->estado }}</option>
                                @endforeach
                            </select>
                            <label>Estado</label>
                        </div>
                        @error('estado')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>






                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="ciudad" class="form-control" 
                                   placeholder="Ciudad..." value="{{ old('ciudad') }}"/>
                            <label>Ciudad</label>
                        </div>
                        @error('ciudad')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="codigo_postal" class="form-control" 
                                   placeholder="Código postal..." value="{{ old('codigo_postal') }}"/>
                            <label>Código postal</label>
                        </div>
                        @error('codigo_postal')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="domiclio_particular" class="form-control" 
                                   placeholder="Domicilio..." value="{{ old('domiclio_particular') }}"/>
                            <label>Domicilio</label>
                        </div>
                        @error('domiclio_particular')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="entre_calles" class="form-control" 
                                   placeholder="Entre calles..." value="{{ old('entre_calles') }}"/>
                            <label>Entre calles</label>
                        </div>
                        @error('entre_calles')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>





                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="telefono2" class="form-control" 
                                   placeholder="Teléfono..." value="{{ old('telefono2') }}"/>
                            <label>Teléfono</label>
                        </div>
                        @error('telefono2')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>




                    <div class="col-md-12">
                        <div class="form-floating">
                            <input name="descripcion" class="form-control" 
                                   placeholder="Descripción..." value="{{ old('descripcion') }}"/>
                            <label>Descripción</label>
                        </div>
                        @error('descripcion')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>







                </form>
            </div>


            <div class="card-footer mw-100 w-px-800 m-md-auto pt-0">
                <div class="btn-group w-100" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-primary" form="frmCreate">Guardar</button>
                  <a href="{{ url('alumnos') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>

        </div>



    </section>



<script type="text/javascript">
$("*#selector").flatpickr( {
  dateFormat: "M / d / Y",
  disableMobile: true,
  noCalendar: false,
  time_24hr: false,
  enableTime: false,
});
</script>

@endsection