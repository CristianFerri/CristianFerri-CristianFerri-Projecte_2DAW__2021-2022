@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="card">
            <div class="card-header">
                Añadir cines
                <span class="float-end">Desea añadir empresas? <a href="{{ route('admin_addEmpresaForm') }}"
                        class="btn btn-success">Añadir empresa</a></span>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin_addCinemas') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="empresa">
                            Empresa<span class="text-danger">*</span>:
                        </label>

                        <select name="empresa_id" class="form-control @error('empresa') is-invalid @enderror" required
                            autofocus>
                            <option selected disabled>Seleccione una empresa...</option>
                            @foreach ($emp as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>

                        @error('empresa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="localidad">
                            Localidad<span class="text-danger">*</span>:
                        </label>

                        <input type="text" name="localidad" class="form-control @error('localidad') is-invalid @enderror"
                            required>

                        @error('localidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="direccion">
                            Direccion <span class="text-danger">*</span>:
                        </label>

                        <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                            required>

                        @error('direccion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telefono">
                            Telefono (opcional):
                        </label>

                        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror">

                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">
                            Correo electronico (opcional):
                        </label>

                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="latitude">
                            Latitud <span class="text-danger">*</span>:
                        </label>

                        <input type="number" step="any" name="latitude"
                            class="form-control @error('latitude') is-invalid @enderror" required>

                        @error('latitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="longitude">
                            Longitud <span class="text-danger">*</span>:
                        </label>

                        <input type="number" step="any" name="longitude"
                            class="form-control @error('longitude') is-invalid @enderror" required>

                        @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="img">
                            Imagen del sitio (opcional):
                        </label>

                        <input type="file" name="img" class="form-control @error('img') is-invalid @enderror">

                        @error('img')
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
