@extends('layouts.app')
<style>
    .cGrid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
</style>
@section('content')
    <div class="container">
        @if (session('alert'))
            <div class="alert alert-{{ session('alert')['type'] }} alert-dismissible fade show" role="alert">
                <strong>{{ session('alert')['message'] }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-center w-50 text-center m-auto mt-5 mb-5">
        <div class="cGrid">
            <a class="btn btn-outline-info" href="{{ route('admin_addCinemasForm') }}">Añadir cines</a>
            <a class="btn btn-outline-info" href="{{ route('admin_addEmpresaForm') }}">Añadir empresas</a>
            <a class="btn btn-outline-info" href="{{ route('admin_addPeliculasForm') }}">Añadir peliculas</a>
            <a class="btn btn-outline-info" href="{{ route('admin_addPeliculasToCineForm') }}">Añadir peliculas a cine</a>
            <a class="btn btn-outline-info" href="{{ route('admin_addSessionsForm') }}">Añadir sesiones de peliculas</a>
            <a class="btn btn-outline-info" href="{{ route('admin_insertarSillonesDBForm') }}">Añadir asientos</a>
        </div>
    </div>
@endsection
