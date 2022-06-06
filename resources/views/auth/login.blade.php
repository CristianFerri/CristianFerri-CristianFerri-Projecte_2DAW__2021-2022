@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/login/fonts/icomoon/style.css') }}">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/login/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/login/css/style.css') }}">
@section('content')
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3>Iniciar sesión</h3>
                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                  adipisicing.</p>
              </div>
              <form method="POST" action="{{ route('login') }}">
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

                <div class="d-flex mb-5 align-items-center">
                  @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                      {{ __('¿Has olvidado la contraseña?') }}
                    </a>
                  @endif
                </div>

                <div class="d-flex justify-content-between">
                  <input type="submit" value="Iniciar sesión" class="btn btn-block btn-primary">
                  <div class="text-center w-100">
                    <p class="text-muted font-weight-bold mt-3">¿No tienes todavía tu cuenta? <a
                        href="{{ route('register') }}" class="text-primary ml-2">Crear una</a>
                    </p>
                  </div>
                </div>

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
