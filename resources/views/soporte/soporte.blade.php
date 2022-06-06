@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!empty($successMsg))
            <div class="alert alert-success">{{ $successMsg }}</div>
        @endif
        <div class="aboutUs">
            <p><strong>
                    Esta página web esta únicamente desarrollada por <u>Cristian Ferri Estruch</u>.
                </strong>
                <br> 
                El próposito esta únicamente enfocado en la entrega del proyecto de final de curso conocido como TFG.
                <br>
                La pagina esta desarrollada gracias a las siguientes tecnologias:
                <ul>
                    <li><span>Laravel</span></li>
                    <li><span>Blade</span></li>
                    <li><span>SCSS</span></li>
                    <li><span>Bootstrap5</span></li>
                    <li><span>FontAwesome</span></li>
                    <li><span>Javascript</span></li>
                    <li><span>Vue</span></li>
                </ul>
                La idea principal de la página es la reserva de entradas online de peliuclas de cine,
                con una implementación de sistema de inicio de sesión el cual los usuarios registrados,
                podran tener acceso a su cuenta para poder personalizar su avatar, correo, informcación básica...
                También se almacenarán las peliculas vistas por el mismo usuario, para después poder hacer alguna valoración sobre las mismas.
                Además cuenta con un sistema de cancelación de entradas con un click.
                El usuario podrá tener métodos de pago guardados para futuras compras.
                En un futuro si se sigue trabajando en la página se podrán observar en la misma 
                página perfiles de otros usuario, y las valoraciones que ellos mismos dejan en las peliculas.
            </p>
        </div>
        <div class="formAboutUs mt-5 text-center">
            @auth
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('myPrivacyPost') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="subject">
                                Asunto del mensaje: 
                            </label>

                            <input 
                                type="text"
                                class="form-control @error('subject') is-invalid @enderror"
                                name="subject"
                                placeholder="Sobre que nos quieres hablar?"
                                required
                                autocomplete="subject"
                                autofocus
                            >

                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message">
                                Mensaje: 
                            </label>

                            <textarea 
                                class="form-control @error('message') is-invalid @enderror"
                                name="message"
                                autocomplete="message"
                                placeholder="Dinos de forma detallada cual es tu problema"
                            ></textarea>

                            @error('message')
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
            @endauth
            @guest
                <p>Necesitas iniciar sesión para ponerte en contacto con el soporte de Ask4UrTicket</p>
                <a class="btn btn-primary" href="{{ url('/login') }}">Iniciar sesión</a>
                <a class="btn btn-primary" href="{{ url('/register') }}">Registrarse</a>
            @endguest
        </div>
    </div>
@endsection
