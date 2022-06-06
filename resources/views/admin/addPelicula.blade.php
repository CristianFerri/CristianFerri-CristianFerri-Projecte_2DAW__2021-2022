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
                <span class="float-end">Desea añadir automaticamente? <a href="{{ route('admin_addPeliculasAuto') }}"
                        class="btn btn-success">Autodetectar</a></span>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin_addPeliculasManual') }}">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="api_id">
                            API_ID de pelicula<span class="text-danger">*</span>:
                        </label>

                        <input type="number" name="api_id" class="form-control @error('api_id') is-invalid @enderror"
                            placeholder="752623" autocomplete="752623" required autofocus>

                        @error('api_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title">
                            Titulo de la peli<span class="text-danger">*</span>:
                        </label>

                        <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="La ciudad perdida"
                            name="title" required>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="poster">
                            Url del poster de la peli<span class="text-danger">*</span>:
                        </label>

                        <input type="text" class="form-control @error('poster') is-invalid @enderror"
                            name="poster" required>

                        @error('poster')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="backdrop">
                            Url del backdrop de la peli<span class="text-danger">*</span>:
                        </label>

                        <input type="text" class="form-control @error('backdrop') is-invalid @enderror"
                            name="backdrop" required>

                        @error('backdrop')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="votes">
                            Url del backdrop de la peli<span class="text-danger">*</span>:
                        </label>

                        <input type="number" class="form-control @error('votes') is-invalid @enderror"
                            name="votes" required>

                        @error('votes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="overview">
                            Sinópsis<span class="text-danger">*</span>:
                        </label>

                        <textarea class="form-control @error('overview') is-invalid @enderror"
                            name="overview" required></textarea>

                        @error('overview')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="releases">
                            Fecha de salida<span class="text-danger">*</span>:
                        </label>

                        <input type="date" class="form-control @error('releases') is-invalid @enderror"
                            name="releases" required />

                        @error('releases')
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
