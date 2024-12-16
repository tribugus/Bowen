@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Nota</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Ver Nota</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">

    <div class="card shadow mb-4">
        <div class="card-body">
            @foreach ($subjects as $subject) 
                @foreach ($enrollments as $enrollment)
                    @if ($enrollment->subject_id == $subject->id)
                        @if ($enrollment->id == $grade->enrollment_id)
                            <h3 class="card-title">{{ $subject->name }}</h3>             
                        @endif
                    @endif
                @endforeach  
                
            @endforeach       
            
            <div class="row">
                <h5>Notas:</h5>
                <div class="d-flex flex-wrap">
                    @foreach ($enrollments as $enrollment)
                        @if ($enrollment->id == $grade->enrollment_id)
                            @foreach ($enrollment->grades as $grade)
                                <p class="lead px-1">{{ $grade->grade }}</p>@if (!$loop->last)-@endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
                @foreach ($enrollments as $enrollment)
                    @if ($enrollment->id == $grade->enrollment_id)
                        <h5 class="mt-3">Promedio ponderado:</h5>
                        <p class="lead">{{ $averageGrades->firstWhere('enrollment_id', $enrollment->id)->average_grade }}</p>
                    @endif
                @endforeach
            </div>    
        </div>
    </div>

</section>

@endsection