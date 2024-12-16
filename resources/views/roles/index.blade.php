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
                            @if(PUR(R1))
                            <a href="{{ url('roles/inactivos') }}" class="btn btn-secondary mxr-1 ">ver inactivos <i class="fa fa-check "></i></a>
                            @endif
                            @if(PUR(R1.R2))
                            <a href="{{ url('roles/crear') }}" class="btn btn-primary">agregar rol <i class="fa fa-add"></i></a>
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
                            <th>Rol</th>
                            <th>Activos</th>
                            <th>Inactivos</th>
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
           +'     <a class="dropdown-item" href="{{ url("/") }}/roles/edit/'+id+'"><i class="bx bx-edit-alt me-1"></i> Edit</a>'
           +'     <form action="{{ url("/") }}/roles/delete/'+id+'"" method="POST">'
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