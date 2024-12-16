@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Entidades</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Aulas</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard"> 
        <div class="card">
            <div class="card-header py-3">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary col-md-11">Aulas</h3>
                    <div class="col-md-1">
                        <a href="{{ route('classrooms.create') }}" class="btn btn-primary"><i class="fa fa-add"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <form class="navbar-search" method="GET" action="{{ route('classrooms.index')}}">
                    <div class="row mt-3">
                        <div class="col-md-auto">
                            <select class="form-select bg-light" data-width="100%" value="{{ $data->records_per_page }}" name="records_per_page">
                                <option {{ $data->records_per_page == 2 ? 'selected' : '' }} value="2">2</option>
                                <option {{ $data->records_per_page == 10 ? 'selected' : '' }} value="10">10</option>
                                <option {{ $data->records_per_page == 15 ? 'selected' : '' }} value="15">15</option>
                                <option {{ $data->records_per_page == 20 ? 'selected ' : '' }} value="20">20</option>
                                <option {{ $data->records_per_page == 50 ? 'selected ' : '' }} value="50">50</option>
                            </select>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group mb-3">
 
                                <input type="text" class="form-control" placeholder="Buscar.." aria-label="Search" name="filter" value="{{ $data->filter }}">
 
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bx bx-search-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Código </th>
                            <th> Capacidad </th>
                            <th> Localización </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classrooms as $classroom)

                            <tr>
                                <td> {{ $classroom->code }} </td>
                                <td> {{ $classroom->capacity }} </td>
                                <td> {{ $classroom->location }} </td>
                                <td>
                                    <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>

                                    <form action="{{ route('classrooms.delete', $classroom->id) }}" style="display:contents" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm btnDelete"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
                
                <nav class="mt-2" aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $classrooms->appends(request()->except('page'))->links('vendor.pagination.custom') }}
                    </ul>
                </nav>

            </div>
        </div>
    </section>

@endsection

<script type="module">

    $(document).ready(function () {

        $('.btnDelete').click(function (event) {

            event.preventDefault();

            Swal.fire({
                title: "¿Desea eliminar el aula?",
                text: "No podrá revertirlo",
                icon: "question",
                showCancelButton: true,
            }).then((result) => {

                if (result.isConfirmed) {

                    const form = $(this).closest('form');

                    form.submit();
                }

            });

        });

    });
</script>