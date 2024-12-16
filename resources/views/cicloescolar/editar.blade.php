@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Nuevo Ciclo escolar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('ciclo-escolar') }}">Ciclos escolares</a></li>
                <li class="breadcrumb-item active">Nuevo Ciclo</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card mb-4">
            <div class="card-body mw-100 w-px-800 m-md-auto">
                <h3 class="card-title">Nuevo Ciclo</h3>

                <form class="row" action="{{ url('ciclo-escolar/update') }}" method="POST" id="frmCreate">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $cic->id }}">

         
                            
                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <input name="ano_ini" type="number" class="form-control" placeholder="Año inicial de ciclo..." value="{{ $cic->ano_ini }}"/>
                                <label>Año inicial de ciclo</label>
                            </div>
                            @error('ano_ini')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-6 mb-4">
                            <div class="form-floating">
                                <input name="ano_fin" type="number" class="form-control" placeholder="Año final de ciclo..." value="{{ $cic->ano_fin }}"/>
                                <label>Año final de ciclo</label>
                            </div>
                            @error('ano_fin')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-3 mb-4">
                            <div class="form-floating">
                                <input name="periodo" type="number" class="form-control" placeholder="1, 2, 3..." value="{{ $cic->periodo }}"/>
                                <label>Periodo</label>
                            </div>
                            @error('periodo')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-9 mb-4">
                            <div class="form-floating">
                                <input name="descripcion" type="text" class="form-control" placeholder="Ciclo escolar actual..." value="{{ $cic->descripcion }}"/>
                                <label>Descripción</label>
                            </div>
                            @error('descripcion')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-4 mb-4">
                            <div class="form-floating">
                                <input name="abreviatura" type="text" class="form-control" placeholder="SEM1-AÑO..." value="{{ $cic->abreviatura }}"/>
                                <label>Abreviatura</label>
                            </div>
                            @error('abreviatura')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="col-12 col-md-4 mb-4">
                            <div class="form-floating">
                                <input name="denominacion" type="text" class="form-control" placeholder="Año, Semestre, Trimestre..." value="{{ $cic->denominacion }}"/>
                                <label>Denominación</label>
                            </div>
                            @error('denominacion')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="col-12 col-md-4 mb-4">
                            <div class="form-floating">
                                <input name="codigo" type="text" class="form-control" placeholder="12345..." value="{{ $cic->codigo }}"/>
                                <label>Código corto</label>
                            </div>
                            @error('codigo')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                            
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input name="date_ini" id="selector" class="form-control" placeholder="Mes y día inicial de ciclo..." value="{{ $cic->date_ini }}"/>
                                <label>Mes y día inicial de ciclo</label>
                            </div>
                            @error('date_ini')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input name="date_fin" id="selector" class="form-control" placeholder="Mes y día final de ciclo..." value="{{ $cic->date_fin }}"/>
                                <label>Mes y día final de ciclo</label>
                            </div>
                            @error('date_fin')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>



                </form>

            </div>

            <div class="card-footer mw-100 w-px-800 m-md-auto pt-0">
                <div class="btn-group w-100" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-primary" form="frmCreate">Guardar</button>
                  <a href="{{ url('ciclo-escolar') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>


        </div>



    </section>



<style>
.cur-year{
    display:none !important;
}
</style>



<script type="text/javascript">
$("*#selector").flatpickr( {
  dateFormat: "M / d",
  disableMobile: true,
  noCalendar: false,
  time_24hr: false,
  enableTime: false,
});
</script>


@endsection