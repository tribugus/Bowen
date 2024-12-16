@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Estudiante</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Ver Estudiante</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">

    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="card-title">{{ $student->first_name }} {{ $student->last_name }}</h3>
            <div class="row">
                <p>Email: {{ $student->email }}</p>
                <p>Fecha de nacimiento: {{ $student->date_of_birth }}</p>
                <p>Dirección: {{ $student->address }}</p>
                <p>Número Telefónico : {{ $student->phone_number }}</p>
            </div>             
        </div>
    </div>

</section>

@endsection