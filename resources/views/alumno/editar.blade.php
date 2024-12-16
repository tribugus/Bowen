@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Editar {{ mb_strtolower($model->nombre) }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('profesores') }}">Profesores</a></li>
                <li class="breadcrumb-item active">Editar {{ mb_strtolower($model->nombre) }}</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card mb-4">
            <div class="card-body mw-100 w-px-800 m-md-auto">

                <h3 class="card-title">Editar {{ mb_strtolower($model->nombre) }}</h3>

                <form class="row g-3" action="{{ url('profesores/update') }}" method="POST" id="frmCreate">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="usuario_id" value="{{ $model->id }}">
                    <input type="hidden" name="profesor_id" value="{{ $model->profesor ? mb_strtoupper($model->profesor->id) : null }}">


                    <div class="col-md-4">
                        <div class="form-floating">
                            <input name="nombre" class="form-control" placeholder="Nombre..." value="{{ mb_strtolower($model->nombre) }}"/>
                            <label>Nombres</label>
                        </div>
                        @error('nombre')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input name="ap_pat" class="form-control" placeholder="Apellido paterno..." value="{{ mb_strtolower($model->ap_pat) }}"/>
                            <label>Apellido paterno</label>
                        </div>
                        @error('ap_pat')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input name="ap_mat" class="form-control" placeholder="Apellido materno..." value="{{ mb_strtolower($model->ap_mat) }}"/>
                            <label>Apellido materno</label>
                        </div>
                        @error('ap_mat')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="correo" type="email" class="form-control" placeholder="Email..." value="{{ mb_strtolower($model->correo) }}"/>
                            <label>Email</label>
                        </div>
                        @error('correo')
                            <div class="error">{{ $message }}</div>
                        @enderror       
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="telefono" type="number" class="form-control" placeholder="Teléfono..." value="{{ mb_strtolower($model->telefono) }}"/>
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



                    <h3 class="card-title mb-1">Datos Profesor</h3>


                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="clave_profesor" class="form-control" placeholder="Clave profesor..." 
                                   value="{{ $model->profesor ? mb_strtolower($model->profesor->clave_profesor) : '' }}" />
                            <label>Clave profesor</label>
                        </div>
                        @error('clave_profesor')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
    
    
                    @php $arg = ['Masculino','Femenino','Otro'];  @endphp
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" name="genero">
                                <option value="">Seleccionar opción</option>

                                @foreach($arg as $v)
                                    @if($model->profesor)
                                        @if($model->profesor->genero==$v)
                                        <option value="{{ $v }}" selected>{{ $v }}</option>
                                        @else
                                        <option value="{{ $v }}" >{{ $v }}</option>
                                        @endif
                                    @else
                                    <option value="{{ $v }}" >{{ $v }}</option>
                                    @endif
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
                                   value="{{ $model->profesor ? mb_strtolower($model->profesor->date) : '' }}"/>

                            <label>Fecha de nacimiento</label>
                        </div>
                        @error('fecha_nacimiento')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="lugar_nacimiento" class="form-control" 
                                   placeholder="Lugar de nacimiento..." value="{{ $model->profesor ? mb_strtolower($model->profesor->lugar_nacimiento) : '' }}"/>
                            <label>Lugar de nacimiento</label>
                        </div>
                        @error('lugar_nacimiento')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    


                    @php $arg2 = ['Soltero(a)','Casado(a)','Divorciado(a)','Viudo(a)'];  @endphp
                    

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" name="estado_civil">
                                <option value="">Seleccionar opción</option>



                                @foreach($arg2 as $v)

                                    @if($model->profesor)
                                        @if($model->profesor->estado_civil==$v)
                                        <option value="{{ $v }}" selected>{{ $v }}</option>
                                        @else
                                        <option value="{{ $v }}" >{{ $v }}</option>
                                        @endif
                                    @else
                                    <option value="{{ $v }}" >{{ $v }}</option>
                                    @endif

                                @endforeach



                            </select>
                            <label>Estado civil</label>
                        </div>
                        @error('estado_civil')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="curp" class="form-control" 
                                   placeholder="CURP..." value="{{ $model->profesor ? mb_strtolower($model->profesor->curp) : '' }}"/>
                            <label>CURP</label>
                        </div>
                        @error('curp')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="no_seguro_social" class="form-control" 
                                   placeholder="Número de seguro social..." value="{{ $model->profesor ? mb_strtolower($model->profesor->no_seguro_social) : '' }}"/>
                            <label>Número de seguro social</label>
                        </div>
                        @error('no_seguro_social')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input name="cedula_fiscal_rfc" class="form-control"
                                   placeholder="Cédula fiscal RFC..." value="{{ $model->profesor ? mb_strtolower($model->profesor->cedula_fiscal_rfc) : '' }}"/>
                            <label>Cédula fiscal RFC</label>
                        </div>
                        @error('cedula_fiscal_rfc')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                </form>



            </div>

            <div class="card-footer mw-100 w-px-800 m-md-auto pt-0">
                <div class="btn-group w-100" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-primary" form="frmCreate">Guardar</button>
                  <a href="{{ url('profesores') }}" class="btn btn-danger">Cancelar</a>
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