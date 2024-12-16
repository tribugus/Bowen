@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Nivel educativo</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Nivel educativo</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">



            <div class="card-header py-3 pb-2">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary">
                        Nivel educativo


                        <div class="float-end">
                            @if(PUR(R1))
                            <a href="{{ url('nivel-educativo') }}" class="btn btn-danger mr-1 ">Quitar filtro <i class="fa fa-close "></i></a>
                            @endif
                            @if(PUR(R1.R2))
                            <a href="{{ url('nivel-educativo/crear') }}" class="btn btn-primary">agregar nivel <i class="fa fa-add"></i></a>
                            @endif
                        </div>


                        
                    </h3>
                </div>
            </div>


            <div class="card-datatable table-responsive p-0 pb-4">

    
                <table id="example" class="table w-100 mb-3 text-muted ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nivel</th>
                            <th>Descripción</th>
                            <th>Director</th>
                            <th>Acuerdo</th>
                            <th>Grados</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>



            </div>


        </div>
    </section>




<script type="text/javascript">
    



function btn(id){
    html = '<div class="dropdown ">'
           +'   <button type="button" class="btn p-0 dropdown-toggle hide-arrow text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx '
           +'           bx-dots-vertical-rounded"></i></button>'
           +'   <div class="dropdown-menu" style="">'
           +'     <form action="{{ url("/") }}/nivel-educativo/active/'+id+'"" method="POST">'
           +'        @csrf'
           +'        <a onclick="active(this)" class="dropdown-item"><i class="bx bx-check me-1 "></i> Activar</a>'
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
    "clave_identificador": "{{ mb_strtoupper($value->clave_identificador) }}",
    "descripcion": "{{ mb_strtolower($value->descripcion) }}",
    "director": "{{ mb_strtolower($value->director->nombre.' '.$value->director->ap_pat.' '.$value->director->ap_mat) }}",
    "acuerdo_creacion_incorporacion": "{{ mb_strtoupper($value->acuerdo_creacion_incorporacion) }}",
    "grados": "{{ $value->grado_ini.'-'.$value->grado_fin }}",
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
        { data: 'clave_identificador' },
        { data: 'descripcion' },
        { data: 'director' },
        { data: 'acuerdo_creacion_incorporacion' },
        { data: 'grados' },
        { data: 'buttons' },
    ]
} );


function active($this){
    event.preventDefault();
    const form = $($this).closest('form');
    Swal.fire({
        icon: 'warning',
        title: "¿Esta seguro de que desea activar?",
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: "Si activar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
}




</script>


@endsection