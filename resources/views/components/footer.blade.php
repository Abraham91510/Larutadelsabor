<style>
.social-hover:hover,
.link-hover:hover { 
    color: #FFC107 !important; 
    transform: scale(1.2); 
    transition: all 0.3s ease; 
}
</style>

<footer class="pt-5" style="background: #0A0A0A;">
    <div class="container px-4">
        <div class="row gy-4">

            <!-- Empresa -->
            <div class="col-md-4 text-center text-md-start">
                <div class="d-flex align-items-center mb-2 justify-content-center justify-content-md-start">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                         style="width: 80px; height: 80px; overflow: hidden; background:#FFC107;">
                        @isset($generales['logo_empresa'])
                            <a href="{{ route('inicio') }}">
                                <img src="{{ asset($generales['logo_empresa']) }}" 
                                     class="w-100 h-100" style="object-fit: cover;">
                            </a>
                        @else
                            <i class="bi bi-shop text-white fs-1"></i>
                        @endisset
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-white">
                            {{ $generales['nombre_empresa'] }}
                        </h4>
                        <p class="mb-0 text-white small">
                            {{ $generales['eslogan_empresa'] }}
                        </p>
                    </div>
                </div>

                <p class="text-white small mt-2">
                    {{ $generales['descripcion_empresa'] }}
                </p>
            </div>

            <!-- Conoce más -->
            <div class="col-md-2">
                <h6 class="fw-bold mb-3 text-white">Conoce Más</h6>
                <ul class="list-unstyled">

                    @foreach($conoceMas as $key => $link)
                        @if(str_starts_with($key,'enlace'))
                            <li>
                                <a href="{{ $link['url'] }}" class="text-white text-decoration-none link-hover">
                                    <i class="{{ $link['icono'] }} me-1"></i>
                                    {{ $link['texto'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                </ul>
            </div>

            <!-- Categorías -->
            <div class="col-md-2">
                <h6 class="fw-bold mb-3 text-white">Categorías</h6>
                <ul class="list-unstyled">
                    @foreach($categorias['items'] as $item)
                        <li>
                            <a href="{{ $item['url'] }}" class="text-white text-decoration-none link-hover">
                                <i class="{{ $item['icono'] }} me-1"></i>
                                {{ $item['texto'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Resto del menú desde BD -->
            @foreach($menu as $opcion)
                @if(!in_array($opcion->slug, ['categorias','inicio','contacto']))
                    <div class="col-md-2">
                        <h6 class="fw-bold mb-3 text-white">
                            {{ $opcion->nombre }}
                        </h6>
                        <ul class="list-unstyled">
                            @foreach($opcion->subopciones as $sub)
                                <li>
                                    <a href="{{ $sub->url }}" class="text-white text-decoration-none link-hover">
                                        <i class="{{ $sub->icono ?? 'bi-circle' }} me-1"></i>
                                        {{ $sub->nombre }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach

        </div>

        <!-- Redes -->
        <div class="text-center mt-4">
            <h6 class="fw-bold text-white">Redes Sociales</h6>
            <ul class="list-unstyled d-flex justify-content-center gap-3">
                @foreach(['facebook','instagram','x','whatsapp','youtube','tiktok'] as $red)
                    @isset($redes[$red])
                        <li>
                            <a href="{{ $redes[$red]['url'] }}" target="_blank" class="text-white fs-4 social-hover">
                                <i class="fa-brands {{ $redes[$red]['icono'] }}"></i>
                            </a>
                        </li>
                    @endisset
                @endforeach
            </ul>
        </div>

        <!-- Derechos -->
        <div class="text-center text-white small mt-4 pb-3 border-top pt-3">
            <i class="{{ $generales['derechos_reservados_empresa']['icono'] }} me-1"></i>
            {{ $generales['derechos_reservados_empresa']['anio'] }}
            <span style="font-family:'Lilita One', cursive;">
                {{ $generales['nombre_empresa'] }}
            </span>.
            {{ $generales['derechos_reservados_empresa']['texto'] }}
        </div>

    </div>
</footer>