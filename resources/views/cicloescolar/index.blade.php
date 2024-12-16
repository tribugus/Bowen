@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Ciclo escolar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Ciclos escolares</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">



            <div class="card-header py-3 pb-2">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary">
                        Ciclos escolares

                        <div class="float-end">
                            @if(PUR(R1))
                            <a href="{{ url('ciclo-escolar/inactivos') }}" class="btn btn-secondary mr-1 ">ver inactivos <i class="fa fa-check "></i></a>
                            @endif
                            @if(PUR(R1.R2))
                            <a href="{{ url('ciclo-escolar/crear') }}" class="btn btn-primary">agregar ciclo <i class="fa fa-add"></i></a>
                            @endif
                        </div>

                        
                    </h3>
                </div>
            </div>


            <div class="card-datatable table-responsive p-0 pb-4">

    
                <table id="example" class="table table-striped w-100 mb-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Inicial</th>
                            <th>Final</th>
                            <th>Periodo</th>
                            <th>Descripción</th>
                            <th>Abreviatura</th>
                            <th>Denominación</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>



            </div>


        </div>
    </section>




<script type="text/javascript">
    



function btn(id){
    html = '<div class="dropdown">'
           +'   <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx '
           +'           bx-dots-vertical-rounded"></i></button>'
           +'   <div class="dropdown-menu" style="">'
           +'     <a class="dropdown-item" href="{{ url("/") }}/ciclo-escolar/edit/'+id+'"><i class="bx bx-edit-alt me-1"></i> Edit</a>'
           +'     <form action="{{ url("/") }}/ciclo-escolar/delete/'+id+'"" method="POST">'
           +'        @csrf @method("DELETE")'
           +'        <a onclick="delte(this)" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a>'
           +'     </form>'
           +'   </div>'
           +' </div>';
    return html;
}

                                   
@php $i = 1; @endphp

let data = [
@foreach($data as $key => $value)
{
    "row": "{{ $i++ }}",
    "ano_ini": "{{ mb_strtolower($value->ano_ini) }}",
    "ano_fin": "{{ mb_strtolower($value->ano_fin) }}",
    "periodo": "{{ mb_strtolower($value->periodo) }}",
    "descripcion": "{{ mb_strtolower($value->descripcion) }}",
    "abreviatura": "{{ mb_strtolower($value->abreviatura) }}",
    "denominacion": "{{ $value->denominacion }}",
    @if(PUR(R1.R2))
    "buttons": btn({{ $value->id }}),
    @else
    "buttons": "",
    @endif

},
@endforeach
];

$('#example').DataTable( {
    data: data,
    columns: [
        { data: 'row' },
        { data: 'ano_ini' },
        { data: 'ano_fin' },
        { data: 'periodo' },
        { data: 'descripcion' },
        { data: 'abreviatura' },
        { data: 'denominacion' },
        { data: 'buttons' },
    ]
} );



function delte($this){
    event.preventDefault();
    const form = $($this).closest('form');
    Swal.fire({
        icon: 'warning',
        title: "¿Esta seguro de que desea eliminar?",
        showConfirmButton: false,
        showDenyButton: true,
        showCancelButton: true,
        denyButtonText: "Si eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isDenied) {
        form.submit();
      }
    });
}



</script>


@endsection