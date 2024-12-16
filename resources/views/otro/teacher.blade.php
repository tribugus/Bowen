@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Profesor</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Ver Profesor</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">

    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="card-title">{{ $teacher->first_name }} {{ $teacher->last_name }}</h3>
            <div class="row">
                <p>Email: {{ $teacher->email }}</p>
                <p>Fecha de nacimiento: {{ $teacher->birthdate }}</p>
                <p>Dirección: {{ $teacher->address }}</p>
                <p>Número Telefónico : {{ $teacher->phone }}</p>
            </div>             
        </div>
    </div>

</section>

@endsection