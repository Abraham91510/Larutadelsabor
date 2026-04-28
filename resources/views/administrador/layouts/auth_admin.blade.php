@include('administrador.componentes.header_auth_admin', [
    'favicon' => $generales['logo_empresa'],
    'titulo' => $generales['nombre_empresa'],
    'subtitulo' => $generales['eslogan_empresa']
])

@yield('content')

@include('administrador.componentes.footer_auth_admin', ['generales' => $generales])

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const input = document.getElementById("password");
    const icon = document.getElementById("togglePassword");

    if(icon){
        icon.addEventListener("click", function(){

            if(input.type === "password"){
                input.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }

        });
    }

});
</script>

</body>
</html>