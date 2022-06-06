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
        Añadir sesiones
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('admin_addSessions') }}">
          @csrf
          @method('POST')

          <div class="form-group">
            <label for="pelicula">
              Pelicula a la que añadir la sesion<span class="text-danger">*</span>:
            </label>

            <select name="pelicula_id" class="form-control @error('pelicula') is-invalid @enderror" required autofocus>
              <option selected disabled>Seleccione una pelicula...</option>
              @foreach ($peliculas as $p)
                <option value="{{ $p->id }}">{{ $p->title }}</option>
              @endforeach
            </select>

            @error('pelicula')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="hora_sesion">
              Hora de la pelicula<span class="text-danger">*</span>:
            </label>

            <input 
              type="time"
              min="09:00"
              max="23:45"
              class="form-control @error('hora_sesion') is-invalid @enderror"
              name="hora_sesion"
              required
            >

            @error('hora_sesion')
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
