@extends('layouts.app')

@section('content')
    <div class="container">
        <success-final :a="{{ Auth()->user() }}" />
    </div>
@endsection
