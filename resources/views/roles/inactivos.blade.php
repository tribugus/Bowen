@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Roles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">



            <div class="card-header py-3 pb-2">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary">
                        Roles

                        <div class="float-end">
                            <a href="{{ url('roles/crear') }}" class="btn btn-primary">agregar rol <i class="fa fa-add"></i></a>
                        </div>

                        <div class="float-end">
                            <a href="{{ url('roles') }}" class="btn btn-danger mx-3 ml-0 ">Quitar filtro <i class="fa fa-close"></i></a>
                        </div>


                    </h3>
                </div>
            </div>


            <div class="card-datatable table-responsive p-0 pb-4">

    
                <table id="example" class="table w-100 mb-3 text-muted ">
                    <thead class="text-muted">
                        <tr>
                            <th class="text-muted">#</th>
                            <th class="text-muted">Rol</th>
                            <th class="text-muted">Activos</th>
                            <th class="text-muted">Inactivos</th>
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
           +'     <form action="{{ url("/") }}/roles/active/'+id+'"" method="POST">'
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
    "roll": "{{ mb_strtolower($value->roll) }}",
    "cant_rol": "{{ $value->usuarios_activos }}",
    "cant_rol2": "{{ $value->usuarios_inactivos }}",
    "buttons": btn({{ $value->id }}),

},
@endforeach
];

$('#example').DataTable( {
    data: data,
    columns: [
        { data: 'row' },
        { data: 'roll' },
        { data: 'cant_rol' },
        { data: 'cant_rol2' },
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