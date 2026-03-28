@props(['menu' => [], 'categorias' => []])

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3">

                {{-- INICIO DESDE BD --}}
                @php
                    $inicio = collect($menu)->firstWhere('slug', 'inicio');
                @endphp
                @if($inicio)
                    @if($inicio->subopciones->count() > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                {{ $inicio->nombre ?? 'Inicio' }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($inicio->subopciones as $sub)
                                    <li>
                                        <a class="dropdown-item" href="{{ $sub->url ?? '#' }}">
                                            <i class="bi {{ $sub->icono ?? 'bi-tag' }} me-2"></i>
                                            {{ $sub->nombre }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $inicio->url ?? '#' }}">
                                {{ $inicio->nombre ?? 'Inicio' }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Inicio
                        </a>
                    </li>
                @endif

                {{-- CATEGORÍAS --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{ $slot_categorias_titulo ?? 'Categorías' }}
                    </a>
                    <ul class="dropdown-menu">
                        @if(isset($categorias['items']) && count($categorias['items']) > 0)
                            @foreach($categorias['items'] as $item)
                                <li>
                                    <a class="dropdown-item" href="{{ $item['url'] ?? '#' }}">
                                        <i class="bi {{ $item['icono'] ?? 'bi-tag' }} me-2"></i>
                                        {{ $item['texto'] ?? 'Categoría' }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li><a class="dropdown-item" href="#"><i class="bi bi-tag me-2"></i>Comida</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-tag me-2"></i>Bebidas</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-tag me-2"></i>Postres</a></li>
                        @endif
                    </ul>
                </li>

                {{-- MENÚ DINÁMICO DESDE BD --}}
                @foreach($menu as $opcion)
                    @if(!in_array($opcion->slug, ['categorias', 'inicio']))
                        @if($opcion->subopciones->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    {{ $opcion->nombre }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($opcion->subopciones as $sub)
                                        <li>
                                            <a class="dropdown-item" href="{{ $sub->url ?? '#' }}">
                                                <i class="bi {{ $sub->icono ?? 'bi-tag' }} me-2"></i>
                                                {{ $sub->nombre }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $opcion->url ?? '#' }}">
                                    {{ $opcion->nombre }}
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach

            </ul>

            {{-- BOTONES --}}
            <div class="d-flex gap-3 align-items-center">
                {!! $slot_acciones ?? '
                    <a href="#" class="btn btn-success rounded-pill">
                        <i class="bi bi-person-plus"></i> Registro
                    </a> 
                    <a href="#" class="btn btn-warning rounded-pill">
                        <i class="bi bi-cart"></i> Carrito
                    </a>
                ' !!}
            </div>

        </div>
    </div>
</nav>