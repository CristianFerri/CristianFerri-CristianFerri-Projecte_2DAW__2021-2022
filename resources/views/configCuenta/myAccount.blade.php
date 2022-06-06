@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="dataContainer">
      <div class="row">
        <div class="col-8">
          <span class="info-image">
            <img src="/storage/{{ Auth::user()->image }}" alt="Imágen de usuario" style="width: 150px"/>
          </span>
          <span class="info-usernames ms-4">
            <span class="fs-1 fw-bold">{{ Auth::user()->username ?? 'DefaultUsername'}}</span>
          </span>
          <br>
          <span class="info-name">
            <span class="fs-4">{{ Auth::user()->name ?? 'John'}}</span>
          </span>
          <span class="info-surname">
            <span class="fs-4">{{ Auth::user()->surname ?? 'Doe Roe'}}</span>
          </span>
          <div class="info-about">
            <span class="fs-5">{{ Auth::user()->about ?? 'Some things about me...'}}</span>
          </div>
        </div>
        <div class="col-4 justify-content-end">
          <a href="{{ route('myAccount.edit') }}" class="btn btn-primary">Editar perfil</a>
        </div>
      </div>
    </div>
  </div>
@endsection