@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Usuarios</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">



            <div class="card-header py-3 pb-2">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary">
                        Usuarios
                        @if(PUR(R1))



                        <div class="float-end">
                            <a href="{{ url('usuarios/crear') }}" class="btn btn-primary">agregar usuario <i class="fa fa-add"></i></a>
                        </div>

                        <div class="float-end">
                            <a href="{{ url('usuarios') }}" class="btn btn-danger mx-3 ml-0 ">Quitar filtro <i class="fa fa-close"></i></a>
                        </div>


                        @endif



                        
                    </h3>
                </div>
            </div>



            <div class="card-datatable table-responsive p-0 pb-4">

    
                <table id="example" class="table w-100 mb-3 text-muted ">
                    <thead class="text-muted">
                        <tr>
                            <th class="text-muted">#</th>
                            <th class="text-muted">Nombre</th>
                            <th class="text-muted">Email</th>
                            <th class="text-muted">Tipo usuario</th>
                            <th class="text-muted"></th>
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
           +'     <form action="{{ url("/") }}/usuarios/active/'+id+'"" method="POST">'
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
    "nombre": "{{ mb_strtolower($value->nombre.' '.$value->ap_pat.' '.$value->ap_mat) }}",
    "correo": "{{ mb_strtolower($value->correo) }}",
    "roll": "{{ mb_strtolower($value->roll ? $value->roll->roll : '') }}",
    @if(PUR(R1))
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
        { data: 'nombre' },
        { data: 'correo' },
        { data: 'roll' },
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