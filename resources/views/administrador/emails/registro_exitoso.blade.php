<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
</head>

<body style="margin:0;padding:0;background:#f0f2f5;font-family:Arial, sans-serif;">

<div style="max-width:600px;margin:30px auto;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 8px 25px rgba(0,0,0,0.1);">

    <!-- HEADER VERDE -->
    <div style="background:#2D9F4F;padding:25px;text-align:center;color:white;">

        <img src="{{ asset($generales['logo_empresa']) }}"
             style="width:80px;height:80px;border-radius:12px;background:white;padding:5px;">

        <h2 style="margin:10px 0 0;font-size:22px;">
            {{ $generales['nombre_empresa'] }}
        </h2>

        <p style="margin:5px 0 0;font-size:13px;opacity:0.9;">
            {{ $generales['eslogan_empresa'] }}
        </p>
    </div>

    <!-- CUERPO -->
    <div style="padding:35px;text-align:center;">

        <h2 style="color:#333;margin-bottom:10px;">
            🎉 ¡Bienvenido, {{ $user->name }}!
        </h2>

        <p style="color:#666;font-size:15px;line-height:1.6;">
            Tu cuenta ha sido creada correctamente en
            <strong>{{ $generales['nombre_empresa'] }}</strong>.
        </p>

        <p style="color:#666;font-size:14px;">
            Ya puedes iniciar sesión y comenzar a usar la plataforma.
        </p>

        <!-- BOTÓN -->
        <a href="http://localhost:8000/login/admin"
           style="display:inline-block;margin-top:25px;padding:12px 28px;background:#2D9F4F;color:white;text-decoration:none;border-radius:8px;font-weight:bold;box-shadow:0 4px 10px rgba(45,159,79,0.3);">
            Iniciar sesión
        </a>

    </div>

    <!-- FOOTER -->
    <div style="background:#f7f7f7;padding:15px;text-align:center;font-size:12px;color:#888;">

        © {{ date('Y') }} {{ $generales['nombre_empresa'] }}  
        <br>
        {{ $generales['eslogan_empresa'] }}

    </div>

</div>

</body>
</html>