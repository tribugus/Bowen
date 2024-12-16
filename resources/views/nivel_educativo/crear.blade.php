@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Nuevo Nivel educativo</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('nivel-educativo') }}">Ciclos escolares</a></li>
                <li class="breadcrumb-item active">Nuevo nivel</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card mb-4">
            <div class="card-body mw-100 w-px-800 m-md-auto">
                <h3 class="card-title">Nuevo Nivel educativo</h3>

                <form class="row" action="{{ url('nivel-educativo/store') }}" method="POST" id="frmCreate">
                    @csrf


         
                            
                        <div class="col-12 col-md-4 mb-4">
                            <div class="form-floating">
                                <input name="clave_identificador" type="text" class="form-control" placeholder="PRIM, SEC, PREP..." value="{{ old('clave_identificador') }}"/>
                                <label>Clave o identifiacdor</label>
                            </div>
                            @error('clave_identificador')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-8 mb-4">
                            <div class="form-floating">
                                <input name="descripcion_nivel" type="text" class="form-control" placeholder="Nivel educatico etc..." 
                                       value="{{ old('descripcion_nivel') }}"/>
                                <label>Descripción del nivel</label>
                            </div>
                            @error('descripcion_nivel')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <input name="acuerdo_creacion_incorporacion" type="text" class="form-control" placeholder="35DF9,179A3584,1G796D564..." value="{{ old('acuerdo_creacion_incorporacion') }}"/>
                                <label>Acuerdo de creción o incorporación</label>
                            </div>
                            @error('acuerdo_creacion_incorporacion')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <select class="form-control" name="director_usuario_id" @if(1>count($dir)) disabled @endif />
                                    <option value="">Seleccionar opción</option>
                                    @foreach ($dir as $val)
                                    <option value="{{ $val->id }}" >{{ mb_strtoupper($val->nombre.' '.$val->ap_pat.' '.$val->ap_mat) }}</option>
                                    @endforeach
                                </select>
                                <label>Director</label>
                            </div>
                            @error('director_usuario_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <input name="grado_ini" type="text" class="form-control" placeholder="1"
                                       value="{{ old('grado_ini') }}"/>
                                <label>Rango inicial de nivel</label>
                            </div>
                            @error('grado_ini')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <input name="grado_fin" type="text" class="form-control" placeholder="1, 3, 6..."
                                       value="{{ old('grado_fin') }}"/>
                                <label>Rango final de nivel</label>
                            </div>
                            @error('grado_fin')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <input name="denominacion_grado" type="text" class="form-control" placeholder="Año, Semestre, Trimestre..."
                                       value="{{ old('denominacion_grado') }}"/>
                                <label>Denominación de Grado</label>
                            </div>
                            @error('denominacion_grado')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <select class="form-control" name="matricula_id" @if(1>count($mat)) disabled @endif />
                                    <option value="">Seleccionar opción</option>
                                    @foreach ($mat as $val)
                                    <option value="{{ $val->id }}" >{{ mb_strtoupper($val->formato) }}</option>
                                    @endforeach
                                </select>
                                <label>Serie para Asignación de Matriculas</label>
                            </div>
                            @error('matricula_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <input name="fecha_incorporacion" id="selector" class="form-control" placeholder="Mes y día inicial de ciclo..." value="{{ old('fecha_incorporacion') }}"/>
                                <label>Fecha de incorporacón</label>
                            </div>
                            @error('fecha_incorporacion')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <input name="zona_escolar" type="number" class="form-control" placeholder="01,02,03..." value="{{ old('zona_escolar') }}"/>
                                <label>Zona escolar</label>
                            </div>
                            @error('zona_escolar')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>




                </form>

            </div>

            <div class="card-footer mw-100 w-px-800 m-md-auto pt-0">
                <div class="btn-group w-100" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-primary" form="frmCreate">Guardar</button>
                  <a href="{{ url('nivel-educativo') }}" class="btn btn-danger">Cancelar</a>
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