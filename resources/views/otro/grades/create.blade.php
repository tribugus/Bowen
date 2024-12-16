@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Entidades</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grades.index') }}">Notas</a></li>
                <li class="breadcrumb-item active">Nueva Nota</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">Nueva Nota</h5>

                <form class="row g-3" action="{{ route('grades.store')}}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="enrollment_id" id="enrollment_id">
                                <option selected value="0">Seleccione</option>
                                @foreach ($enrollments as $enrollment)                 
                                    <option value="{{ $enrollment->id }}">{{ $enrollment->id }}</option>
                                @endforeach
                            </select>
                            <label for="enrollment_id">Matricula</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="student_name" class="form-control" placeholder="Estudiante" disabled>
                            <label for="student_name">Estudiante</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="subject_name" class="form-control" placeholder="Asignatura" disabled>
                            <label for="subject_name">Asignatura</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="academic_year" class="form-control" placeholder="Año Académico" disabled>
                            <label for="academic_year">Año Académico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="grade" id="grade" class="form-control" placeholder="Calificación">
                            <label for="grade">Calificación</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('grades.index')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>
        
    </section>

@endsection

<script>

    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('enrollment_id').addEventListener('change', function() {
            var enrollment_id = this.value;
            $.ajax({
                url: "/enrollments/getEnrollmentData/" + enrollment_id,
                method: "GET",
                success: function(data) {
                    console.log(data)
                    // Actualiza los campos con los nuevos datos
                    $('input[name="student_name"]').val(data.student.first_name + ' ' + data.student.last_name);
                    $('input[name="subject_name"]').val(data.subject.name);
                    $('input[name="academic_year"]').val(data.academic_year);
                }
            });
        }); 
    });

</script>