@extends('layouts.app')

@section('content')
    <div class="m-auto text-center mt-5">
        <h1>{{ $alert['httpcode'] }} ERROR</h1>
        <h4>{{ $alert['message'] }}</h4>

        <a href="{{ route('Inicio') }}" class="btn btn-dark">Inicio</a>
    </div>
@endsection
