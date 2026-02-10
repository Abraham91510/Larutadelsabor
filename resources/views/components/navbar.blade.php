<nav class="navbar navbar-light bg-white border-bottom py-3">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center gap-2">
            
            <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center" style="width:45px;height:45px; overflow:hidden;">
                @if(isset($slot_logo))
                    <img src="{{ $slot_logo }}" alt="Logo" class="w-100 h-100" style="object-fit:cover;">
                @else
                    <i class="bi bi-shop fs-4 text-white"></i> 
                @endif
            </div>

        
            <div class="d-flex flex-column">
                <strong>{{ $slot_titulo ?? 'La Ruta del Sabor' }}</strong>
                <small class="text-warning">{{ $slot_eslogan ?? 'Siempre visible. Siempre a tiempo.' }}</small>
            </div>
        </div>


        <div class="flex-grow-1 mx-3 d-none d-md-block">
            <input type="text" class="form-control rounded-pill" placeholder="{{ $slot_placeholder ?? 'Buscar comerciantes...'}}">
        </div>


        <div class="d-flex gap-3 align-items-center">
            {!! $slot_acciones ?? '<span><i class="bi bi-geo-alt"></i> Mi ubicación</span> <a href="#" class="btn btn-success rounded-pill">Iniciar sesión</a>' !!}
        </div>

    </div>
</nav>

