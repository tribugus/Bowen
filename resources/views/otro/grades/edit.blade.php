@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Entidades</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grades.index') }}">Notas</a></li>
                <li class="breadcrumb-item active">Editar Nota</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">Editar Nota</h5>

                <form class="row g-3" action="{{ route('grades.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="enrollment_id" id="enrollment_id">
                                <option selected value="{{ $enrollmentSelected->id }}">{{ $enrollmentSelected->id }}</option>
                                @foreach ($enrollments as $enrollment)  
                                    @if ($enrollmentSelected->id != $enrollment->id)              
                                        <option value="{{ $enrollment->id }}">{{ $enrollment->id }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="enrollment_id">Matricula</label>
                        </div>
                        <div class="form-floating mb-3">
                            @foreach($students as $student)
                                @if($enrollmentSelected->student_id == $student->id)
                                    <input name="student_name" class="form-control" placeholder="Estudiante" value="{{ $student->first_name }} {{ $student->last_name }}" disabled>
                                @endif
                            @endforeach
                            <label for="student_name">Estudiante</label>
                        </div>
                        <div class="form-floating mb-3">
                            @foreach($subjects as $subject)
                                @if($enrollmentSelected->subject_id == $subject->id)
                                    <input name="subject_name" class="form-control" placeholder="Asignatura" value="{{ $subject->name }}" disabled>
                                @endif
                            @endforeach
                            <label for="subject_name">Asignatura</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="academic_year" class="form-control" placeholder="Año Académico" value="{{ $enrollmentSelected->academic_year }}" disabled>
                            <label for="academic_year">Año Académico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="grade" id="grade" class="form-control" placeholder="Calificación" value="{{ $grade->grade }}" >
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