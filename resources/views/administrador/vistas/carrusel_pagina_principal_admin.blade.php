@extends('administrador.layouts.dashboard_admin')

@section('content')
<h2>Carrusel Página Principal</h2>

<button class="btn btn-success mb-3" onclick="abrirModalNuevo()">
    <i class="fa fa-plus"></i> Agregar Slide
</button>

<div class="table-responsive">
    <table id="tablaCarrusel" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Icono</th>
                <th>Título</th>
                <th>Texto</th>
                <th>Orden</th>
                <th>Acciones</th>
                <th>Estado</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>
                    <img src="/{{ $item->imagen }}" style="width:80px;height:60px;object-fit:cover;border-radius:8px;">
                </td>

                <td class="text-center">
                    <i class="{{ $item->icono }}"
                       style="color: {{ $item->icono_color }};
                              font-size: {{ $item->icono_size ?? '20px' }};">
                    </i>
                </td>

                <td>{{ $item->titulo }}</td>
                <td>{{ $item->texto }}</td>
                <td>{{ $item->orden }}</td>

                <td>
                    <button class="btn btn-primary"
                        onclick="abrirModalEditar(
                            {{ $item->id }},
                            `{{ $item->titulo }}`,
                            `{{ $item->texto }}`,
                            `{{ $item->icono }}`,
                            {{ $item->orden }},
                            '{{ $item->imagen }}',
                            '{{ $item->icono_color }}',
                            '{{ $item->icono_size }}',
                            '{{ $item->titulo_color }}',
                            '{{ $item->titulo_size }}',
                            '{{ $item->texto_color }}',
                            '{{ $item->texto_size }}'
                        )">
                        <i class="fa fa-pencil"></i>
                    </button>
                </td>

                <td>
                    <button class="btn {{ $item->is_active ? 'btn-danger' : 'btn-success' }}"
                        onclick="toggleEstado({{ $item->id }})">
                        {{ $item->is_active ? 'Desactivar' : 'Activar' }}
                    </button>
                </td>

                <td>
                    <button class="btn btn-dark" onclick="eliminar({{ $item->id }})">
                        Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL --}}
<div class="modal fade" id="modalCarrusel" tabindex="-1">
    <div class="modal-dialog">
        <form id="formCarrusel" enctype="multipart/form-data">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Formulario Slide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id">

                    <label>Título</label>
                    <input type="text" id="titulo" class="form-control">

                    <label class="mt-2">Texto</label>
                    <textarea id="texto" class="form-control"></textarea>

                    <label class="mt-2">Icono</label>
                    <input type="text" id="icono" class="form-control">

                    <label class="mt-2">Orden</label>
                    <input type="number" id="orden" class="form-control">

                    <label class="mt-2">Imagen</label>
                    <input type="file" id="imagenInput" class="form-control">

                    <div id="previewContainer" class="mt-3 text-center" style="display:none;">
                        <img id="imgPreview" style="width:100%;max-height:200px;object-fit:cover;border-radius:10px;">
                    </div>

                    <hr>

                    <h6>Estilos</h6>

                    <label>Color Icono</label>
                    <input type="color" id="icono_color" class="form-control">

                    <label>Tamaño Icono</label>
                    <input type="text" id="icono_size" class="form-control" placeholder="30px">

                    <label class="mt-2">Color Título</label>
                    <input type="color" id="titulo_color" class="form-control">

                    <label>Tamaño Título</label>
                    <input type="text" id="titulo_size" class="form-control">

                    <label class="mt-2">Color Texto</label>
                    <input type="color" id="texto_color" class="form-control">

                    <label>Tamaño Texto</label>
                    <input type="text" id="texto_size" class="form-control">

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>

<script>
$(document).ready(function () {
    $('#tablaCarrusel').DataTable();
});

let dt = new DataTransfer();

function abrirModalNuevo(){
    $('#formCarrusel')[0].reset();
    $('#id').val('');
    dt = new DataTransfer();
    $('#previewContainer').hide();
    $('#modalCarrusel').modal('show');
}

function abrirModalEditar(id, titulo, texto, icono, orden, imagen,
    icono_color, icono_size, titulo_color, titulo_size, texto_color, texto_size){

    $('#id').val(id);
    $('#titulo').val(titulo);
    $('#texto').val(texto);
    $('#icono').val(icono);
    $('#orden').val(orden);

    $('#icono_color').val(icono_color);
    $('#icono_size').val(icono_size);

    $('#titulo_color').val(titulo_color);
    $('#titulo_size').val(titulo_size);

    $('#texto_color').val(texto_color);
    $('#texto_size').val(texto_size);

    if(imagen){
        $('#imgPreview').attr('src','/'+imagen);
        $('#previewContainer').show();
    }

    $('#modalCarrusel').modal('show');
}

$('#formCarrusel').on('submit', function(e){
    e.preventDefault();

    let id = $('#id').val();

    let formData = new FormData();
    formData.append('_token','{{ csrf_token() }}');

    formData.append('titulo',$('#titulo').val());
    formData.append('texto',$('#texto').val());
    formData.append('icono',$('#icono').val());
    formData.append('orden',$('#orden').val());

    formData.append('icono_color',$('#icono_color').val());
    formData.append('icono_size',$('#icono_size').val());

    formData.append('titulo_color',$('#titulo_color').val());
    formData.append('titulo_size',$('#titulo_size').val());

    formData.append('texto_color',$('#texto_color').val());
    formData.append('texto_size',$('#texto_size').val());

    let file = $('#imagenInput')[0].files[0];
    if(file){
        formData.append('imagen',file);
    }

    let url = id ? '/carrusel_pagina_principal/'+id : '/carrusel_pagina_principal/store';
    if(id) formData.append('_method','PUT');

    fetch(url,{method:'POST',body:formData})
    .then(r=>r.json())
    .then(d=>{
        if(d.error) alert(d.msg);
        else location.reload();
    });
});

function toggleEstado(id){ fetch('/carrusel_pagina_principal/toggle/'+id).then(()=>location.reload()); }

function eliminar(id){
    if(confirm('¿Eliminar?')){
        fetch('/carrusel_pagina_principal/'+id,{
            method:'DELETE',
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}
        }).then(()=>location.reload());
    }
}
</script>
@endsection