<footer class="footer-auth text-center">

    <div class="mb-1 fw-bold">
        {{ $generales['nombre_empresa'] ?? '' }}
    </div>

    <div class="small mb-1">
        {{ $generales['eslogan_empresa'] ?? '' }}
    </div>

    <div class="small text-light">
        <i class="{{ $generales['derechos_reservados_empresa']['icono'] ?? '' }}"></i>
        {{ $generales['derechos_reservados_empresa']['anio'] ?? '' }}
        {{ $generales['nombre_empresa'] ?? '' }}.
        {{ $generales['derechos_reservados_empresa']['texto'] ?? '' }}
    </div>

</footer>