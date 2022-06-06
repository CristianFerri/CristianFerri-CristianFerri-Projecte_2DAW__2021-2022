@extends('layouts.app')

@section('content')
  <div class="container">
    @if (session('alert'))
        <div class="alert alert-{{ session('alert')['type'] }}"> alert-dismissible fade show" role="alert">
          <strong>{{ session('alert')['message'] }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
      <div class="card-header">
        Editar Información personal básica
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('myPrivacyPost') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="email">
              Correo electronico: 
            </label>

            <input 
              type="email"
              class="form-control @error('email') is-invalid @enderror"
              name="email"
              value="{{ Auth::user()->email }}"
              required
              autocomplete="email"
              autofocus
            >

            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="phone">
              Teléfono de contacto: 
            </label>

            <input 
              type="number"
              class="form-control @error('phone') is-invalid @enderror"
              name="phone"
              value="{{ Auth::user()->phone ?? '612 345 678' }}"
              autocomplete="phone"
            >

            @error('phone')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="passowrd">
              Contraseña: 
            </label>

            <input 
              type="password"
              class="form-control @error('password') is-invalid @enderror"
              name="password"
            >

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="confirm-password">
              Confirmación de la contraseña:
            </label>

            <input 
              type="password"
              class="form-control @error('confirm-password') is-invalid @enderror"
              name="confirm-password"
            >

            @error('confirm-password')
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
