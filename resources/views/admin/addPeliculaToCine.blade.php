@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $errors->first() }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Añadir peliculas
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin_addPeliculasToCine') }}">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="cine">
                            Cine<span class="text-danger">*</span>:
                        </label>

                        <select name="cine_id" class="form-control @error('cine') is-invalid @enderror" required autofocus>
                            <option selected disabled>Seleccione un cine...</option>
                            @foreach ($cines as $c)
                                <option value="{{ $c->id }}">{{ $c->nombre }} {{ $c->localidad }}</option>
                            @endforeach
                        </select>

                        @error('cine')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="peli">
                            Pelicula a añadir<span class="text-danger">*</span>:
                        </label>

                        <select name="pelicula_id" class="form-control @error('peli') is-invalid @enderror" required>
                            <option selected disabled>Seleccione una pelicula...</option>
                            @foreach ($pelis as $p)
                                <option value="{{ $p->id }}">{{ $p->title }}</option>
                            @endforeach
                        </select>

                        @error('peli')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input class="form-control btn btn-primary mt-4" type="submit" value="Enviar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
