@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">
        Editar Información personal básica
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('myAccountPost') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="username">
              Nombre de usuario: 
            </label>

            <input 
              type="text"
              class="form-control @error('username') is-invalid @enderror"
              name="username"
              value="{{ Auth::user()->username }}"
              required
              autocomplete="username"
              autofocus
            >

            @error('username')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="name">
              Nombre: 
            </label>

            <input 
              type="text"
              class="form-control @error('name') is-invalid @enderror"
              name="name"
              value="{{ Auth::user()->name ?? 'John' }}"
              autocomplete="name"
            >

            @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="surname">
              Apellidos: 
            </label>

            <input 
              type="text"
              class="form-control @error('surname') is-invalid @enderror"
              name="surname"
              value="{{ Auth::user()->surname ?? 'Doe Roe' }}"
              autocomplete="surname"
            >

            @error('surname')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="surname">
              Sobre mí: 
            </label>

            <textarea 
              class="form-control @error('about') is-invalid @enderror"
              name="about"
              autocomplete="about"
            >{{ Auth::user()->about ?? 'Some things about me...' }}</textarea>

            @error('about')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="image">
              Imágen de perfil: 
            </label>

            <input 
              type="file"
              class="form-control @error('image') is-invalid @enderror"
              name="image"
            >

            @error('image')
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
