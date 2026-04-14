@extends('layouts.secundario')

@section('titulopagina', 'Comentarios')
@section('favicon', $generales['logo_empresa'])

@push('css')
<style>
    .card-comentario{
        border-radius: 15px;
        transition: 0.3s;
    }

    .card-comentario:hover{
        transform: scale(1.02);
    }

    .rating i{
        font-size: 1.2rem;
    }
</style>
@endpush

@section('titulo')
    {{ $generales['nombre_empresa'] }}
@endsection

@section('subtitulo')
    {{ $generales['eslogan_empresa'] }}
@endsection

@section('contenedor_contenido')

<div class="container">

    <!-- 🔥 FORMULARIO COMENTARIOS -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">

                    <h4 class="mb-4">
                        <i class="bi bi-chat-dots me-2"></i>
                        Deja tu opinión
                    </h4>

                    <form method="POST" action="{{ route('comentarios.store') }}">
                        @csrf

                        <!-- NOMBRE DE LA COMIDA (USANDO BUSCADOR) -->
                        <div class="mb-3">
                            <label class="form-label">Nombre de la comida</label>
                            <select name="producto" id="buscador" class="form-control" required>

                                @foreach($buscador['DatosBuscador'] ?? [] as $categoria => $opciones)

                                    <optgroup label="{{ $categoria }}">
                                        @foreach($opciones as $opcion)
                                            <option value="{{ $opcion['texto'] }}">
                                                {{ $opcion['texto'] }}
                                            </option>
                                        @endforeach
                                    </optgroup>

                                @endforeach

                            </select>
                        </div>

                        <!-- OPINIÓN -->
                        <div class="mb-3">
                            <label class="form-label">Opinión</label>
                            <textarea name="opinion" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- ⭐ ESTRELLAS -->
                        <div class="mb-3">
                            <label class="form-label">Calificación</label>

                            <div>
                                <input type="hidden" name="rating" id="ratingInput" value="">

                                <div class="d-flex gap-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <a href="#" class="rating-opcion" data-value="{{ $i }}">
                                            <i class="bi bi-star text-muted"></i>
                                        </a>
                                    @endfor
                                </div>

                                <small id="ratingTexto" data-default="Selecciona una calificación">
                                    Selecciona una calificación
                                </small>
                            </div>
                        </div>

                        <button class="btn btn-success w-100">
                            <i class="bi bi-send"></i> Enviar comentario
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- 🔥 LISTA DE COMENTARIOS -->
    <div class="row">

        @forelse($comentarios ?? [] as $comentario)

            <div class="col-md-4 mb-4">
                <!-- COMPONENTE -->
                <x-card-comentario
                    :titulo="$comentario->producto"
                    :texto="$comentario->opinion"
                    :rating="$comentario->rating"
                />
            </div>

        @empty

            <div class="text-center py-5">
                <i class="bi bi-chat-square-text fs-1 text-muted"></i>
                <p class="mt-3">No hay comentarios aún</p>
            </div>

        @endforelse

    </div>

</div>

@endsection