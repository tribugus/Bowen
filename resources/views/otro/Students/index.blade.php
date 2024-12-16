@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Entidades</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Estudiantes</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard"> 
        <div class="card">
            <div class="card-header py-3">
                <div class="row">
                    <h3 class="m-0 font-weight-bold text-primary col-md-11">Estudiantes</h3>
                    <div class="col-md-1">
                        <a href="{{ route('students.create') }}" class="btn btn-primary"><i class="fa fa-add"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <form class="navbar-search" method="GET" action="{{ route('students.index')}}">
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
                            <th> Nombres </th>
                            <th> Apellidos </th>
                            <th> Email </th>
                            <th> Fecha de Nacimiento </th>
                            <th> Género </th>
                            <th> Dirección </th>
                            <th> Celular </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)

                            <tr>
                                <td> {{ $student->first_name }} </td>
                                <td> {{ $student->last_name }} </td>
                                <td> {{ $student->email }} </td>
                                <td> {{ $student->date_of_birth }} </td>
                                <td> {{ $student->gender }} </td>
                                <td> {{ $student->address }} </td>
                                <td> {{ $student->phone_number }} </td>
                                <td>
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>

                                    <form action="{{ route('students.delete', $student->id) }}" style="display:contents" method="POST">
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
                        {{ $students->appends(request()->except('page'))->links('vendor.pagination.custom') }}
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
                title: "¿Desea eliminar el estudiante?",
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
