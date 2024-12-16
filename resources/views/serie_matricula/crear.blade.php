@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Nueva Serie de matrícula</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('serie-matricula') }}">Matrículas</a></li>
                <li class="breadcrumb-item active">Nueva matrícula</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card mb-4">
            <div class="card-body mw-100 w-px-800 m-md-auto">
                <h3 class="card-title">Nueva Matrícula</h3>

                <form class="row" action="{{ url('serie-matricula/store') }}" method="POST" id="frmCreate">
                    @csrf

                            


                    <div class="col-12 col-md-12 mb-4">
                        <div class="form-floating ">
                            <input type="text" name="formato" class="form-control text-uppercase" placeholder="Formato inicial..."  
                                   value="{{ old('formato') }}" />
                            <label>Formato matrícula </label>
                        </div>
                        @error('formato')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>




                    <div class="col-12 col-md-6 mb-4">
                        <div class="form-floating">
                            <input name="consecutivo_matricula" type="number" class="form-control" placeholder="1..." value="{{ old('consecutivo_matricula') }}"/>
                            <label>Concecutivo de matrícula</label>
                        </div>
                        @error('consecutivo_matricula')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                        <div class="form-floating">
                            <input name="limite_matricula" type="number" class="form-control" placeholder="9999..." value="{{ old('limite_matricula') }}"/>
                            <label>Limte para matrículas</label>
                        </div>
                        @error('limite_matricula')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">

                        <div class="flex space-x-4 border-0">
                            <input name="permitir_modificar" id="tack_checkbox" type="checkbox" class="form-checkbox">
                            <label for="tack_checkbox" class="mb-0 cursor-pointer">
                                ¿Esta matrícula de serie, se modifica?
                            </label>
                        </div>

                    </div>




                </form>

            </div>

            <div class="card-footer mw-100 w-px-800 m-md-auto pt-0">
                <div class="btn-group w-100" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-primary" form="frmCreate">Guardar</button>
                  <a href="{{ url('serie-matricula') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>



        </div>



        <div class="flex items-center p-3.5 rounded border border-primary">
            <span class="mw-100 w-px-800 m-md-auto pt-0">

              <p>Una matrícula se construye de hasta 20 caracteres alfanuméricos (números o letras).</p>
              <p>El formato podrá contener los siguientes elementos especiales, encerrado de [ ] :<br></p>

              <div align="justify">
                <ul>
                  <li><strong>[nnnnn] : </strong>Código del nivel en la matrícula.</li>
                  <li><strong>[aaaa o aa] : </strong>Año escolar en formato largo (aaaa) o corto (aa).</li>
                  <li><strong>[iiii] o [ii] : </strong>Año inicial del ciclo escolar de ingreso en formato largo (iiii) o corto (ii).</li>
                  <li><strong>[ffff] o [ff] : </strong>Año final del ciclo escolar de ingreso en formato largo (ffff) o corto (ff).</li>
                  <li><strong>[cc] : </strong>Código corto del ciclo escolar de ingreso.</li>
                  <li><strong>[ggggg] : </strong>Grado en formato numérico.</li>
                  <li><strong>[p] : </strong>Incorporar letras del apellido paterno (número de p indica cuántas letras se incluirán).</li>
                  <li><strong>[m] : </strong>Incorporar letras del apellido materno (similar a p).</li>
                  <li><strong>[????] o [?] : </strong>Número consecutivo. El número de signos '?' determina cuántas posiciones tendrá el número consecutivo, llenando con ceros a la izquierda si es necesario.</li>
                  <li><strong>[plan] : </strong>Clave del plan de estudios asignado al estudiante.</li>
                  <li>Otros números y letras libremente designados que se incluirán en la matrícula final.</li>
                </ul>
              </div>
           
            </span>
        </div>




    </section>



<style type="text/css">
.form-checkbox:checked, .form-radio:checked {
    background-color: #013E51  !important;
}
.form-checkbox {
    padding: 10px !important; 
}
</style>



@endsection