@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Matricula</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Ver Matricula</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">

    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="card-title">Año Académico: {{ $enrollment->academic_year }}</h3>
            <div class="row">
                @foreach ($students as $student)
                    @if ($enrollment->student_id == $student->id)
                        <p>Estudiante: {{ $student->first_name }} {{ $student->last_name }} </p>
                    @endif
                @endforeach
                @foreach ($subjects as $subject)
                    @if ($enrollment->subject_id == $subject->id)
                        <p>Asignatura: {{ $subject->name }} </p>
                    @endif
                @endforeach       
            </div>             
        </div>
    </div>

</section>

@endsection