@extends('administrador.layouts.dashboard_admin')

@section('content')
<h2>Gestión de Tipos de Servicios</h2>

<button class="btn btn-success mb-3" onclick="abrirModalNuevo()">
    <i class="fa fa-plus"></i> Agregar Tipo de Servicio
</button>

<div class="table-responsive">
    <table id="tablaTDS" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Icono</th>
                <th>Estilos (Badge)</th>
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

                {{-- ICONO --}}
                <td class="text-center">
                    <div class="{{ $item->bg_clase }} p-2 rounded d-inline-block">
                        <i class="{{ $item->icono }} {{ $item->color_icono }} fs-3"></i>
                    </div>
                </td>

                {{-- ESTILOS --}}
                <td>
                    <small>
                        <b>Fondo:</b> <code>{{ $item->bg_clase }}</code>
                    </small>
                </td>

                {{-- TITULO --}}
                <td class="fw-bold">
                    {{ $item->titulo }}
                </td>

                {{-- TEXTO --}}
                <td>
                    {!! $item->texto !!}
                </td>

                {{-- ORDEN --}}
                <td class="text-center">
                    {{ $item->orden }}
                </td>

                {{-- EDITAR --}}
                <td>
                    <button class="btn btn-primary"
                        onclick="abrirModalEditar(
                            {{ $item->id }},
                            `{{ $item->titulo }}`,
                            `{{ $item->texto }}`,
                            `{{ $item->icono }}`,
                            `{{ $item->color_icono }}`,
                            `{{ $item->bg_clase }}`,
                            {{ $item->orden }}
                        )">
                        <i class="fa fa-pencil"></i>
                    </button>
                </td>

                {{-- ESTADO --}}
                <td>
                    <button class="btn {{ $item->is_active ? 'btn-danger' : 'btn-success' }}"
                        onclick="toggleEstado({{ $item->id }})">
                        {{ $item->is_active ? 'Desactivar' : 'Activar' }}
                    </button>
                </td>

                {{-- ELIMINAR --}}
                <td>
                    <button class="btn btn-dark"
                        onclick="eliminar({{ $item->id }})">
                        Eliminar
                    </button>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL --}}
<div class="modal fade" id="modalTDS" tabindex="-1">
    <div class="modal-dialog">
        <form id="formTDS">
            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Formulario Tipo de Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id">

                    <label>Título</label>
                    <input type="text" id="titulo" class="form-control">

                    <label class="mt-2">Descripción</label>
                    <textarea id="texto" class="form-control"></textarea>

                    <div class="row mt-2">
                        <div class="col-6">
                            <label>Icono</label>
                            <input type="text" id="icono" class="form-control">
                        </div>
                        <div class="col-6">
                            <label>Color Icono</label>
                            <input type="text" id="color_icono" class="form-control">
                        </div>
                    </div>

                    <div class="mt-2">
                        <label>Fondo</label>
                        <input type="text" id="bg_clase" class="form-control">
                    </div>

                    <label class="mt-2">Orden</label>
                    <input type="number" id="orden" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Guardar Cambios
                    </button>
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
    $('#tablaTDS').DataTable();
});

function abrirModalNuevo(){
    $('#formTDS')[0].reset();
    $('#id').val('');
    $('#modalTitle').text('Agregar Nuevo');
    $('#modalTDS').modal('show');
}

function abrirModalEditar(id, titulo, texto, icono, colorI, bg, orden){
    $('#id').val(id);
    $('#titulo').val(titulo);
    $('#texto').val(texto);
    $('#icono').val(icono);
    $('#color_icono').val(colorI);
    $('#bg_clase').val(bg);
    $('#orden').val(orden);
    $('#modalTitle').text('Editar Servicio');
    $('#modalTDS').modal('show');
}

$('#formTDS').on('submit', function(e){
    e.preventDefault();

    let id = $('#id').val();
    let titulo = $('#titulo').val().trim();
    let texto = $('#texto').val().trim();

    if(!titulo || !texto){
        alert('Título y Texto son obligatorios');
        return;
    }

    let formData = new FormData(this);
    formData.append('titulo', titulo);
    formData.append('texto', texto);

    let url = id ? '/tipos-servicios/' + id : '/tipos-servicios/store';

    if(id){
        formData.append('_method','PUT');
    }

    fetch(url,{
        method:'POST',
        body:formData,
        headers:{ 'Accept':'application/json' }
    })
    .then(r => r.json())
    .then(d => {
        if(d.error){
            alert(d.msg);
        }else{
            location.reload();
        }
    });
});

function toggleEstado(id){
    fetch('/tipos-servicios-toggle/'+id)
    .then(()=>location.reload());
}

function eliminar(id){
    if(confirm("¿Borrar?")){
        fetch('/tipos-servicios/'+id,{
            method:'DELETE',
            headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
        }).then(()=>location.reload());
    }
}

</script>
@endsection