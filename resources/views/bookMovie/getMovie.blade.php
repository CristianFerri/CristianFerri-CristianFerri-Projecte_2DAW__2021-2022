@extends('layouts.app')

@section('content')
    <get-movie-info :movie="{{ $movie }}" :cine="{{ $cine }}" />
@endsection
