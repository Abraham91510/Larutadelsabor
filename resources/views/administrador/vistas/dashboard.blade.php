@extends('administrador.layouts.dashboard_admin')

@section('content')

<h1>Dashboard</h1>

@if(session('user')->role == 'admin')
    <p>ADMIN</p>
@else
    <p>INVITADO</p>
@endif

@include('administrador.componentes.card', [
    'title' => 'Ejemplo',
    'texto_tarjeta' => 'Contenido',
    'imagen' => 'Imagenes/paisaje.jpg'
])

@endsection