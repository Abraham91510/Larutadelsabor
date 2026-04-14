@extends('administrador.layouts.app')

@section('content')

<h2>Login</h2>

<form method="POST" action="/login">
    @csrf

    <input type="email" name="email" required>
    <input type="password" name="password" required>

    <button>Entrar</button>
</form>

@endsection