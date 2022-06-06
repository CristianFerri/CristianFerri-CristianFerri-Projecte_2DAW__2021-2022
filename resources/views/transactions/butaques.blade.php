@extends('layouts.app')

@section('content')
    <t-butaques :cine="{{ $cine }}" :peli="{{ $peli }}" :salas="{{ $salas }}" :reservas="{{ $reservas }}" :asientos="{{ $asientos }}" />
@endsection
