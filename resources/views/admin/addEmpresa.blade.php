@extends('layouts.app')

@section('content')
  <div class="container mt-5 mb-5">
    <div class="card">
      <div class="card-header">
        Añadir empresas
        <span class="float-end">Desea añadir cines? <a href="{{ route('admin_addCinemasForm') }}" class="btn btn-success">Añadir cines</a></span>
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('admin_addEmpresa') }}">
          @csrf
          @method('POST')
          <div class="form-group">
            <label for="empresa">
              Nombre de empresa<span class="text-danger">*</span>: 
            </label>

            <input
                type="text"
                class="form-control @error('empresa') is-invalid @enderror"
                name="nombre"
                required
            >

            @error('empresa')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="director">
              Director (opcional): 
            </label>

            <input
              type="text"
              name="director"
              class="form-control @error('director') is-invalid @enderror"
            >

            @error('director')
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
