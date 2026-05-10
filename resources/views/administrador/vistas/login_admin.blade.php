@extends('administrador.layouts.auth_admin')

@section('titulopagina', 'Login de Administrador')

@push('css')
<style>
    .btn-login {
        background: #2D9F4F;
        color: white;
        border-radius: 8px;
        width: 100%;
    }

    .btn-login:hover {
        background: #24813f;
    }

    .login-title i {
        color: #2D9F4F;
    }

    .login-title h3 {
        font-weight: 700;
    }

    /* Link registro */
    .link-registro {
        text-align: center;
        margin-top: 12px;
        font-size: 14px;
    }

    .link-registro a {
        color: #2D9F4F;
        font-weight: 600;
        text-decoration: none;
    }

    .link-registro a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')

<div class="contenedor-auth">

    {{-- TITULO EMPRESA --}}
    <div class="titulo-box">
        <h1>{{ $generales['nombre_empresa'] ?? '' }}</h1>
        <h5>{{ $generales['eslogan_empresa'] ?? '' }}</h5>
    </div>

    <div class="card-auth">

        {{-- HEADER LOGIN --}}
        <div class="text-center mb-4 login-title">
            <i class="bi bi-box-arrow-in-right fs-1"></i>
            <h3 class="mt-2">Iniciar Sesión</h3>
        </div>

        @if(session('error'))
<div class="alert alert-danger d-flex align-items-center">
    <img src="{{ asset($generales['logo_empresa']) }}" width="28" class="me-2">
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success d-flex align-items-center">
    <img src="{{ asset($generales['logo_empresa']) }}" width="28" class="me-2">
    {{ session('success') }}
</div>
@endif

        {{-- FORM LOGIN --}}
        <form method="POST" action="/login/admin">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            {{-- PASSWORD CON OJO --}}
            <div class="mb-3 password-container">
                <label>Contraseña</label>

                <div class="input-wrapper">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                </div>
            </div>

           <div class="p-3 mb-3 text-center" style="border: 1px solid #ced4da; border-radius: 15px; background-color: #f8f9fa;">
    <p class="fw-bold mb-3" style="color: #6c757d; font-size: 0.85rem; text-transform: uppercase;">
        Verificación de Seguridad
    </p>
    
    <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
        <!-- Imagen generada por nuestro controlador -->
        <div style="background: #212529; border-radius: 8px; padding: 5px; display: flex; align-items: center;">
          <img src="{{ route('captcha.simple') }}" id="captcha-img" style="border-radius:4px;">
        </div>
        
        <!-- Botón de recarga (Vanilla JS) -->
        <button type="button"
onclick="document.getElementById('captcha-img').src='{{ route('captcha.simple') }}?'+Math.random()">
↻
</button>
    </div>

    <div class="px-2">
        <input type="text" 
               name="captcha" 
               class="form-control text-center" 
               placeholder="Ingresa el código anterior" 
               style="border-radius: 25px; border: 2px solid #80bdff; height: 45px;" 
               required>
    </div>
</div>

            <button type="submit" class="btn btn-login">
                Entrar
            </button>

        </form>

        {{-- LINK A REGISTRO --}}
        <div class="link-registro">
            ¿No tienes cuenta?
            <a href="{{ url('/registrar/admin') }}">
                Regístrate aquí
            </a>
        </div>

    </div>
</div>

@endsection