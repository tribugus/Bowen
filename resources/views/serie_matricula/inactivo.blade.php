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
                            <a href="{{ url('serie-matricula') }}" class="btn btn-danger mr-1 ">Quitar filtro <i class="fa fa-close "></i></a>
                            @endif
                            @if(PUR(R1.R2))
                            <a href="{{ url('serie-matricula/crear') }}" class="btn btn-primary">agregar matricula <i class="fa fa-add"></i></a>
                            @endif
                        </div>
                        
                    </h3>
                </div>
            </div>


            <div class="card-datatable table-responsive p-0 pb-4">

    
                <table id="example" class="table w-100 mb-3 text-muted ">
                    <thead class="text-muted">
                        <tr>
                            <th class="text-muted">#</th>
                            <th class="text-muted">Formato</th>
                            <th class="text-muted">Matricula</th>
                            <th class="text-muted">Límite</th>
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
           +'     <form action="{{ url("/") }}/serie-matricula/active/'+id+'"" method="POST">'
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
    "formato": "{{ mb_strtoupper(preg_replace('/[\[\]]/', '', $value->formato)) }}",
    "consecutivo_matricula": "{{ $value->consecutivo_matricula }}",
    "limite_matricula": "{{ $value->limite_matricula }}",
    "buttons": btn({{ $value->id }}),

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