@extends('layouts.app')

@section('content')
    <t-resumen :info="{{ $infoSillones }}" :cupons="{{ $cupones }}" :salanum="{{ $salaNumero }}" :sala="{{ $sala }}" />
@endsection
