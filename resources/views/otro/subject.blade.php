@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Asignatura</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Ver Asignatura</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">

    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="card-title">{{ $subject->name }}</h3>
            <div class="row">
                <p>Año Académico: {{ $subject->grade_level }}</p>
                <p>Horario: {{ $subject->schedule }}</p>
                @foreach ($teachers as $teacher)
                    @if ($subject->teacher_id == $teacher->id)
                        <p>Docente: {{ $teacher->first_name }} {{ $teacher->last_name }}</p>
                    @endif
                @endforeach
                @foreach ($classrooms as $classroom)
                    @if ($subject->classroom_id == $classroom->id)
                        <p>Aula: {{ $classroom->location }} - {{ $classroom->code }}</p>
                    @endif
                @endforeach
                
            </div>             
        </div>
    </div>

</section>

@endsection