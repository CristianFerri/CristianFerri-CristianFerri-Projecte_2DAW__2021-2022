@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/login/fonts/icomoon/style.css') }}">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/login/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/login/css/style.css') }}">

@section('content')
  <div class="container">
    @if (session('alert'))
      <div class="alert alert-{{ session('alert')['type'] }} alert-dismissible fade show" role="alert">
        <strong>{{ session('alert')['message'] }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="dataContainer">
      <div class="row">
        <div class="col-6 m-auto">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3>Editar información privada</h3>
                <p class="mb-4">Para editar tu información deberas verificar que realmente eres tu</p>
              </div>
              <form method="GET" action="{{ route('myAccountPrivacy.edit') }}">
                @csrf
                <div class="form-group first">
                  <label for="email" class="col-md-4 col-form-label">Dirección de correo</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group last mb-4">
                  <label for="password" class="col-md-4 col-form-label">Contraseña</label>
                  <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" name="password"
                    required autocomplete="current-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror

                </div>

                <input type="submit" value="Editar información" class="btn btn-block btn-primary text-center">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

<script src="{{ asset('css/login/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('css/login/js/popper.min.js') }}"></script>
<script src="{{ asset('css/login/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('css/login/js/main.js') }}"></script>
