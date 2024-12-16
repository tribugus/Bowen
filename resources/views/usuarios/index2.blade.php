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
                        <div class="float-end">
                            <a href="{{ url('usuarios/crear') }}" class="btn btn-primary">agregar usuario <i class="fa fa-add"></i></a>
                        </div>
                    </h3>
                </div>
            </div>


            <div class="card-body p-0 pb-4">

    
                <table id="example" class="table table-striped table-responsive w-100 mb-3">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo usuario</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>



            </div>


        </div>
    </section>




<form id="Fdelete" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>




<script type="text/javascript">
    



function FDelete(id){
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
        var form = document.getElementById('Fdelete');
        form.setAttribute('action', '{{ url("/") }}/usuarios/delete/'+id);
        form.submit();
      }
    });

}

function btn(id){
    html = '<div class="dropdown">'
           +'   <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx '
           +'           bx-dots-vertical-rounded"></i></button>'
           +'   <div class="dropdown-menu" style="">'
           +'     <a class="dropdown-item" href="{{ url("/") }}/usuarios/edit/'+id+'"><i class="bx bx-edit-alt me-1"></i> Edit</a>'
           //+'     <form action="{{ url("/") }}/usuarios/delete/'+id+'"" method="POST">'
           //+'        @csrf @method("DELETE")'
           +'        <button class="dropdown-item" onclick="FDelete('+id+')"><i class="bx bx-trash me-1"></i> Delete</button>'
           //+'     </form>'
           +'   </div>'
           +' </div>';
    return html;
}

                                   


let data = [
@foreach($data as $key => $value)
{
    "nombre": "{{ mb_strtolower($value->nombre.' '.$value->ap_pat.' '.$value->ap_mat) }}",
    "correo": "{{ mb_strtolower($value->correo) }}",
    "roll": "{{ mb_strtolower($value->roll->roll) }}",
    "buttons": btn({{ $value->id }}),

},
@endforeach
];

$('#example').DataTable( {
    data: data,
    columns: [
        { data: 'nombre' },
        { data: 'correo' },
        { data: 'roll' },
        { data: 'buttons' },
    ]
} );





</script>


@endsection