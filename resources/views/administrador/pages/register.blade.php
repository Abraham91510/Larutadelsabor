@extends('administrador.layouts.app')

@section('content')

<h2>Registro</h2>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" required>
    <input type="email" name="email" required>
    <input type="password" name="password" required>

    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="invitado">Invitado</option>
    </select>

    <button>Registrar</button>
</form>

@endsection