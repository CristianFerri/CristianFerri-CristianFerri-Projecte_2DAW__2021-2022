@extends('layouts.app')

@section('content')
  <div class="container">
    @if (isset($_SESSION['messageCE']))
        <div class="alert alert-info }} alert-dismissible fade show" role="alert">
            <strong>{{ $_SESSION['messageCE'] }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="dataContainer">
      <div class="cancelar-entrada">
        @if (count($entradas) != 0)
          <table class="w-100">
            <tr class="text-center">
              <th>Cine</th>
              <th>Pelicula</th>
              <th>Dia y hora de la pelicula</th>
              <th>Precio total</th>
              <th>Número de asientos</th>
            </tr>
            @foreach ($entradas as $e)
              <tr class="text-center" >
                <td>{{ $e->nombre }} {{ $e->localidad }}</td>
                <td>{{ $e->title }}</td>
                <td>{{ $e->dia_expiracion }}</td>
                <td>{{ $e->precio_total }}€</td>
                <td>{{ $e->numero_asientos }}</td>
                <td>
                  <form action="{{ route('cancelarEntrada', ['idEntrada' => $e->id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-warning" type="submit">Cancelar entrada</button></td>
                  </form>
              <tr>
            @endforeach
          </table>
        @else
          <div class="msg">No has adquirido ninguna entrada de momento</div>
        @endif
      </div>
    </div>
  </div>
@endsection
