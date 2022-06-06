@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/register/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

@section('content')
  <div class="container">
    <div class="row py-5 mt-4 align-items-center">
      <!-- For Demo Purpose -->
      <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
        <img src="https://bootstrapious.com/i/snippets/sn-registeration/illustration.svg" alt=""
          class="img-fluid mb-3 d-none d-md-block">
        <h1>Crea tu cuenta ahora!</h1>
        <p class="font-italic text-muted mb-0">Nulla blandit lorem a tristique molestie. Nunc sodales mi in neque commodo, non interdum dui fermentum. Vestibulum laoreet libero id lobortis rhoncus.</p>
        <p class="font-italic text-muted">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos <a href="#"
            class="text-muted">
            <u>consectetur adipisicing.</u></a>
        </p>
      </div>

      <!-- Registeration Form -->
      <div class="col-md-7 col-lg-6 ml-auto">
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="row">
            <!-- Username -->
            <div class="input-group col-lg-12 mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white px-4 border-md border-right-0">
                  <i class="fa fa-user text-muted"></i>
                </span>
              </div>
              <input id="username" type="text" name="username" placeholder="Nombre de usuario" autofocus
                class="form-control bg-white border-left-0 border-md @error('username') is-invalid @enderror"
                required>

              @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <!-- Email Address -->
            <div class="input-group col-lg-12 mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white px-4 border-md border-right-0">
                  <i class="fa fa-envelope text-muted"></i>
                </span>
              </div>
              <input id="email" type="email" name="email" placeholder="Correo electronico"
                class="form-control bg-white border-left-0 border-md @error('email') is-invalid @enderror"
                required>

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <!-- Password -->
            <div class="input-group col-lg-6 mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white px-4 border-md border-right-0">
                  <i class="fa fa-lock text-muted"></i>
                </span>
              </div>
              <input id="password" type="password" name="password" placeholder="Contraseña"
                class="form-control bg-white border-left-0 border-md @error('password') is-invalid @enderror"
                required>

              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="input-group col-lg-6 mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white px-4 border-md border-right-0">
                  <i class="fa fa-lock text-muted"></i>
                </span>
              </div>
              <input id="password-confirm" type="password" name="password_confirmation"
                placeholder="Confirmar contraseña" class="form-control bg-white border-left-0 border-md"
                required>
            </div>

            <!-- Submit Button -->
            <div class="form-group col-lg-12 mx-auto mb-0">
              <input type="submit" class="btn btn-primary btn-block py-2 font-weight-bold" value="Crear tu cuenta">
            </div>

            <!-- Already Registered -->
            <div class="text-center w-100">
              <p class="text-muted font-weight-bold mt-3">¿Ya estas registrado? <a href="{{ route('login') }}"
                  class="text-primary ml-2">Iniciar sesión</a></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('css/register/main.js') }}"></script>
