<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

    
        <div class="collapse navbar-collapse" id="mainNavbar">

        
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3">
                {{-- Inicio --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ $slot_inicio_url ?? '#' }}">
                        {{ $slot_inicio_texto ?? 'Inicio' }}
                    </a>
                </li>

        
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ $slot_categorias_titulo ?? 'Categorías' }}
                    </a>
                    <ul class="dropdown-menu">
                        @if(isset($slot_categorias_items))
                            {!! $slot_categorias_items !!}
                        @else
                            <li><a class="dropdown-item" href="#">Comida</a></li>
                            <li><a class="dropdown-item" href="#">Bebidas</a></li>
                            <li><a class="dropdown-item" href="#">Postres</a></li>
                        @endif
                    </ul>
                </li>

                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ $slot_comerciantes_titulo ?? 'Comerciantes' }}
                    </a>
                    <ul class="dropdown-menu">
                        @if(isset($slot_comerciantes_items))
                            {!! $slot_comerciantes_items !!}
                        @else
                            <li><a class="dropdown-item" href="#">Cerca de mí</a></li>
                            <li><a class="dropdown-item" href="#">Mejor calificados</a></li>
                            <li><a class="dropdown-item" href="#">Nuevos</a></li>
                        @endif
                    </ul>
                </li>

                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ $slot_como_funciona_titulo ?? 'Cómo funciona' }}
                    </a>
                    <ul class="dropdown-menu">
                        @if(isset($slot_como_funciona_items))
                            {!! $slot_como_funciona_items !!}
                        @else
                            <li><a class="dropdown-item" href="#">Clientes</a></li>
                            <li><a class="dropdown-item" href="#">Comerciantes</a></li>
                            <li><a class="dropdown-item" href="#">Pagos</a></li>
                        @endif
                    </ul>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{ $slot_contacto_url ?? '#' }}">
                        {{ $slot_contacto_texto ?? 'Contacto' }}
                    </a>
                </li>
            </ul>

            
            <div class="d-flex gap-3 align-items-center">
                {!! $slot_acciones ?? '<a href=\"#\" class=\"text-warning fw-bold text-decoration-none\">Sé comerciante</a> <a href=\"#\" class=\"btn btn-warning rounded-pill\"><i class=\"bi bi-cart\"></i> Carrito</a>' !!}
            </div>

        </div>
    </div>
</nav>
