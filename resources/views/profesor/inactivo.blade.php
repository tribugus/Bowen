@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Profesores</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Profesores</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">



            <div class="card-header py-3 pb-2">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary">
                        Profesores
                        <div class="float-end">
                            @if(PUR(R1))
                            <a href="{{ url('profesores') }}" class="btn btn-danger mr-1 ">Quitar filtro <i class="fa fa-close "></i></a>
                            @endif
                            @if(PUR(R1.R2))
                            <a href="{{ url('profesores/crear') }}" class="btn btn-primary">agregar nivel <i class="fa fa-add"></i></a>
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
                            <th>Clave Profesor</th>
                            <th>Profesor</th>
                            <th>CURP</th>
                            <th>NSS</th>
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
           +'     <form action="{{ url("/") }}/profesores/active/'+id+'"" method="POST">'
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

    "clave_profesor": "{!! $value->profesor ? mb_strtoupper($value->profesor->clave_profesor) : '<i class=\'bx bx-x\' ></i>' !!}",

    "profesor": "{{ mb_strtolower($value->nombre.' '.$value->ap_pat.' '.$value->ap_mat) }}",

    "curp": "{!! $value->profesor ? mb_strtoupper($value->profesor->curp) : '<i class=\'bx bx-x\' ></i>' !!}",
    "nss": "{!! $value->profesor ? mb_strtoupper($value->profesor->no_seguro_social) : '<i class=\'bx bx-x\' ></i>' !!}",
    
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
        { data: 'clave_profesor' },
        { data: 'profesor' },
        { data: 'curp' },
        { data: 'nss' },
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