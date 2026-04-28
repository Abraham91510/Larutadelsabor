@extends('administrador.layouts.auth_admin')

@section('titulopagina', 'Registro de Administrador')

@push('css')
<style>
    .btn-registro {
        background: #2D9F4F;
        color: white;
        border-radius: 8px;
        width: 100%;
        transition: all 0.3s;
    }

    .btn-registro:hover {
        background: #24813f;
        transform: translateY(-2px);
    }

    .registro-title i {
        color: #2D9F4F;
    }

    .registro-title h3 {
        font-weight: 700;
    }

    .link-login {
        text-align: center;
        margin-top: 12px;
        font-size: 14px;
    }

    .link-login a {
        color: #2D9F4F;
        font-weight: 600;
        text-decoration: none;
    }

    .link-login a:hover {
        text-decoration: underline;
    }

    /* Estilo para el ojo de la contraseña */
    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
        z-index: 10;
    }
</style>
@endpush

@section('content')

<div class="contenedor-auth">

    <div class="titulo-box">
        <h1>{{ $generales['nombre_empresa'] ?? '' }}</h1>
        <h5>{{ $generales['eslogan_empresa'] ?? '' }}</h5>
    </div>

    <div class="card-auth">
        <div class="text-center mb-4 registro-title">
            <i class="bi bi-person-plus-fill fs-1"></i>
            <h3 class="mt-2">Crear cuenta</h3>
        </div>

        {{-- Alertas de sesión --}}
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulario --}}
        <form method="POST" action="{{ url('/registrar/admin') }}" enctype="multipart/form-data" id="formRegistro">
            @csrf

            <div class="mb-3">
                <label class="fw-bold">Nombre completo</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}"
                    oninput="this.value = this.value.replace(/^\s+/, '')">
            </div>

            <div class="mb-3">
    <label class="fw-bold">Correo electrónico</label>
    <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}"
        oninput="this.value = this.value.replace(/\s/g, '')">

    @error('email')
    <div class="alert alert-danger d-flex align-items-center mt-2">
        <img src="{{ asset($generales['logo_empresa']) }}" width="28" class="me-2" alt="logo">
        <span class="small fw-bold">{{ $message }}</span>
    </div>
    @enderror
</div>

            <div class="mb-3">
    <label class="fw-bold">Foto de perfil</label>
    <input type="file" name="foto" id="fotoInput" class="form-control" 
           accept="image/png, image/jpeg, image/jpg" required>
</div>

           <div class="mb-3">
    <label class="fw-bold">Contraseña</label>
    
    <div class="input-wrapper">
        <input type="password" name="password" id="password" class="form-control" required
            oninput="this.value = this.value.replace(/^\s+/, '')">
        <i class="bi bi-eye-slash" id="togglePassword"></i>
    </div>

    @error('password')
    <div class="alert alert-danger d-flex align-items-center mt-2">
        {{-- Usamos el logo de la empresa para darle identidad al error --}}
        <img src="{{ asset($generales['logo_empresa']) }}" width="28" class="me-2" alt="logo">
        <span class="small fw-bold">{{ $message }}</span>
    </div>
    @enderror

    <small class="text-muted d-block mt-1">
        La contraseña debe tener al menos: 
        <strong>8 caracteres, una mayúscula y un símbolo especial.</strong>
    </small>
</div>

            <div class="mb-3">
                <label class="fw-bold">Rol de usuario</label>
                <select name="role" class="form-select" required>
                    <option value="admin" selected>Administrador</option>
                    <option value="invitado">Invitado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-registro py-2 fw-bold shadow-sm">
                Registrar cuenta
            </button>
        </form>

        <div class="link-login mt-4">
            ¿Ya tienes cuenta?
            <a href="{{ url('/login/admin') }}">Inicia sesión aquí</a>
        </div>
    </div>
</div>

@push('js')
<script>
    // 1. Mostrar/Ocultar contraseña
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    // 2. Validación básica de tamaño de imagen antes de subir (opcional pero ayuda)
    document.getElementById('fotoInput').onchange = function() {
        if(this.files[0].size > 2097152) { // 2MB
           alert("¡La imagen es muy pesada! Máximo 2MB.");
           this.value = "";
        }
    };
</script>

<script>
    form.onsubmit = function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const role = document.getElementById('role').value;
        const foto = document.getElementById('fotoInput').value; // Nueva validación

        if (name === "" || email === "" || password === "" || role === "" || foto === "") {
            e.preventDefault();
            jsAlertText.innerText = "No se puede registrar: Todos los campos, incluyendo la foto, son obligatorios.";
            jsAlert.classList.remove('d-none');
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return false;
        }
    };
</script>

@endpush

@endsection