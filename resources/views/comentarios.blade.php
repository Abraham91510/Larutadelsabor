@extends('layouts.secundario')

@section('titulopagina', 'Comentarios')
@section('favicon', $generales['logo_empresa'])

@push('css')
<style>
    .fondo { background: #2D9F4F; }
    body { font-family: 'Nunito', sans-serif !important; }
    h1 { font-family: 'Lilita One', cursive !important; }

    .card-resena {
        border: none;
        border-radius: 20px;
        background: #000000; 
        color: #ffffff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    /* CONTENEDOR DE ESTRELLAS */
    .contenedor-estrellas {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 20px 0;
    }

    .estrella-voto {
        font-size: 3.5rem;
        cursor: pointer;
        color: #444 !important; /* Gris por defecto */
        transition: all 0.2s ease;
    }

    /* Clase que aplica el color AMARILLO ORO cuando se selecciona */
    .activa {
        color: #FFD700 !important; /* Amarillo brillante */
        text-shadow: 0 0 15px rgba(255, 215, 0, 0.7);
        transform: scale(1.1);
    }

    .estrella-voto:hover {
        color: #FFD700 !important;
        transform: scale(1.2);
    }

    /* Buscador nativo con diseño limpio */
    .buscador-limpio {
        border-radius: 12px;
        padding: 14px;
        border: 2px solid #333;
        background: #ffffff;
        color: #000;
        width: 100%;
        font-weight: 600;
    }
    
    .buscador-limpio:focus {
        border-color: #2D9F4F;
        outline: none;
    }
</style>
@endpush

@section('contenedor_contenido')
<div class="container py-4">
    <div class="text-center mb-4">
        <h1 class="display-5" style="color: #1a1a1a;">Comentarios</h1>
        <p class="text-muted">Comparte tu experiencia con nosotros</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-resena shadow">
                <div class="card-body p-4">
                    <form id="formComentario" method="POST" action="{{ route('comentarios.store') }}">
                        @csrf

                        <div class="mb-4 text-start">
                            <label class="form-label fw-bold" style="color: #2D9F4F;">¿Qué producto quieres calificar?</label>
                            <input list="productosList" name="producto" id="productoInput" class="buscador-limpio" placeholder="Escribe el nombre del producto..." required autocomplete="off">
                            <datalist id="productosList">
                                @foreach($buscador['DatosBuscador'] ?? [] as $categoria => $opciones)
                                    @foreach($opciones as $opcion)
                                        <option value="{{ $opcion['texto'] }}">
                                    @endforeach
                                @endforeach
                            </datalist>
                        </div>

                        <div class="mb-4 text-start">
                            <label class="form-label fw-bold" style="color: #2D9F4F;">Tu opinión:</label>
                            <textarea name="opinion" class="form-control" rows="4" style="border-radius: 12px;" required placeholder="Escribe aquí tu comentario..."></textarea>
                        </div>

                        <div class="text-center">
                            <label class="form-label fw-bold" style="color: #2D9F4F;">Calificación:</label>
                            <input type="hidden" name="rating" id="valorRating" required>
                            
                            <div class="contenedor-estrellas">
                                <i class="bi bi-star-fill estrella-voto" data-idx="1"></i>
                                <i class="bi bi-star-fill estrella-voto" data-idx="2"></i>
                                <i class="bi bi-star-fill estrella-voto" data-idx="3"></i>
                                <i class="bi bi-star-fill estrella-voto" data-idx="4"></i>
                                <i class="bi bi-star-fill estrella-voto" data-idx="5"></i>
                            </div>
                            <small id="errorRating" class="text-danger fw-bold" style="display:none;">¡No olvides seleccionar las estrellas!</small>
                        </div>

                        <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-3 mt-3 shadow-lg">
                            PUBLICAR COMENTARIO
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const estrellas = document.querySelectorAll('.estrella-voto');
        const inputRating = document.getElementById('valorRating');
        const errorMsg = document.getElementById('errorRating');

        estrellas.forEach(estrella => {
            // Al hacer CLICK
            estrella.addEventListener('click', function() {
                const seleccionada = this.getAttribute('data-idx');
                inputRating.value = seleccionada; // Guardamos el valor real
                
                errorMsg.style.display = 'none';

                // Pintamos las estrellas de amarillo
                estrellas.forEach(est => {
                    if (parseInt(est.getAttribute('data-idx')) <= parseInt(seleccionada)) {
                        est.classList.add('activa');
                    } else {
                        est.classList.remove('activa');
                    }
                });
            });
        });

        // Validación final antes de enviar
        document.getElementById('formComentario').addEventListener('submit', function(e) {
            if (!inputRating.value) {
                e.preventDefault();
                errorMsg.style.display = 'block';
                // Animación simple de sacudida al error
                errorMsg.classList.add('animate__animated', 'animate__shakeX');
            }
        });
    });
</script>
@endpush