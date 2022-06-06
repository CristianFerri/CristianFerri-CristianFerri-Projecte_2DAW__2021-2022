@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="card">
            <div class="card-header">
                Añadir sillones
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin_insertarSillonesDB') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-dark" value="Insertar asientos">
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
