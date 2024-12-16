@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Series de matrícula</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Matrículas</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">



            <div class="card-header py-3 pb-2">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary">
                        Series de matrícula


                        <div class="float-end">
                            @if(PUR(R1))
                            <a href="{{ url('serie-matricula/inactivos') }}" class="btn btn-secondary mr-1 ">ver inactivos <i class="fa fa-check "></i></a>
                            @endif
                            @if(PUR(R1.R2))
                            <a href="{{ url('serie-matricula/crear') }}" class="btn btn-primary">agregar matricula <i class="fa fa-add"></i></a>
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
                            <th>Formato</th>
                            <th>Matricula</th>
                            <th>Límite</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>



            </div>


        </div>
    </section>




<script type="text/javascript">
    



function btn(id,b){

    var bolen = b;
    @if(PUR(R1))
        bolen = 1;
    @endif
    if(bolen==1){
        abtn = '<a class="dropdown-item" href="{{ url("/") }}/serie-matricula/edit/'+id+'"><i class="bx bx-edit-alt me-1"></i> Edit</a>';
    }else{
        abtn = '';
    }


    html = '<div class="dropdown">'
           +'   <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx '
           +'           bx-dots-vertical-rounded"></i></button>'
           +'   <div class="dropdown-menu" style="">'
           +abtn
           +'     <form action="{{ url("/") }}/serie-matricula/delete/'+id+'"" method="POST">'
           +'        @csrf @method("DELETE")'
           +'        <a onclick="delte(this)" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a>'
           +'     </form>'
           +'   </div>'
           +'</div>';
    return html;
}

                                   
@php $i = 1; @endphp

let data = [
@foreach($data as $key => $value)
{
    "row": "{{ $i++ }}",
    "formato": "{{ mb_strtoupper(preg_replace('/[\[\]]/', '', $value->formato)) }}",
    "consecutivo_matricula": "{{ $value->consecutivo_matricula }}",
    "limite_matricula": "{{ $value->limite_matricula }}",
    @if(PUR(R1.R2))
    "buttons": btn({{ $value->id }},{{ $value->permitir_modificar }}),
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
        { data: 'formato' },
        { data: 'consecutivo_matricula' },
        { data: 'limite_matricula' },
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