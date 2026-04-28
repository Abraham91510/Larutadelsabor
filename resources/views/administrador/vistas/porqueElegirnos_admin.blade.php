@extends('administrador.layouts.dashboard_admin')

@section('content')
<h2>Gestión "¿Por qué elegirnos?"</h2>

<button class="btn btn-success mb-3" onclick="abrirModalNuevo()">
    <i class="fa fa-plus"></i> Agregar Beneficio
</button>

<div class="table-responsive">
    <table id="tablaPE" class="table table-striped table-bordered">
        <thead>
            <tr>
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
                <td class="text-center">
                    <i class="{{ $item->icono }} {{ $item->color_icono }} fs-3"></i>
                </td>
                <td>{{ $item->titulo }}</td>
                <td>{{ $item->texto }}</td>
                <td>{{ $item->orden }}</td>
                <td>
                    <button class="btn btn-primary" onclick="abrirModalEditar({{ $item->id }}, `{{ $item->titulo }}`, `{{ $item->texto }}`, `{{ $item->icono }}`, `{{ $item->color_icono }}`, {{ $item->orden }})">
                        <i class="fa fa-pencil"></i>
                    </button>
                </td>
                <td>
                    <button class="btn {{ $item->is_active ? 'btn-danger' : 'btn-success' }}" onclick="toggleEstado({{ $item->id }})">
                        {{ $item->is_active ? 'Desactivar' : 'Activar' }}
                    </button>
                </td>
                <td>
                    <button class="btn btn-dark" onclick="eliminar({{ $item->id }})">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL ÚNICO --}}
<div class="modal fade" id="modalPE" tabindex="-1">
    <div class="modal-dialog">
        <form id="formPE">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Formulario Beneficio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id">

                    <label>Título</label>
                    <input type="text" id="titulo" class="form-control" placeholder="Ej: Pago Seguro">

                    <label class="mt-2">Descripción</label>
                    <textarea id="texto" class="form-control" rows="2"></textarea>

                    <div class="row mt-2">
                        <div class="col-6">
                            <label>Icono (Bootstrap Icons)</label>
                            <input type="text" id="icono" class="form-control" placeholder="bi bi-star">
                        </div>
                        <div class="col-6">
                            <label>Color Texto</label>
                            <input type="text" id="color_icono" class="form-control" placeholder="text-primary">
                        </div>
                    </div>

                    <label class="mt-2">Orden</label>
                    <input type="number" id="orden" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
    $('#tablaPE').DataTable();
});

function abrirModalNuevo() {
    $('#formPE')[0].reset();
    $('#id').val('');
    $('#modalTitle').text('Agregar Nuevo Beneficio');
    $('#modalPE').modal('show');
}

function abrirModalEditar(id, titulo, texto, icono, color, orden) {
    $('#formPE')[0].reset();
    $('#id').val(id);
    $('#modalTitle').text('Editar Beneficio');
    $('#titulo').val(titulo);
    $('#texto').val(texto);
    $('#icono').val(icono);
    $('#color_icono').val(color);
    $('#orden').val(orden);
    $('#modalPE').modal('show');
}

$('#formPE').on('submit', function(e) {
    e.preventDefault();

    let id = $('#id').val();
    let titulo = $('#titulo').val().trim();
    let texto = $('#texto').val().trim();
    let icono = $('#icono').val().trim();
    let color = $('#color_icono').val().trim();
    let orden = $('#orden').val();

    // VALIDACIONES
    if (!titulo || !texto || !icono || !orden) {
        alert('Todos los campos son obligatorios.');
        return;
    }

    let formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('titulo', titulo);
    formData.append('texto', texto);
    formData.append('icono', icono);
    formData.append('color_icono', color);
    formData.append('orden', orden);

    let url = id ? '/porque-elegirnos/' + id : '/porque-elegirnos/store';
    if (id) formData.append('_method', 'PUT');

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: { 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(d => {
        if (d.error) { alert(d.msg); } 
        else { location.reload(); }
    });
});

function toggleEstado(id){ fetch('/porque-elegirnos-toggle/' + id).then(() => location.reload()); }

function eliminar(id){
    if(confirm("¿Eliminar este beneficio? Se quitará de la página de inicio.")){
        fetch('/porque-elegirnos/' + id, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => location.reload());
    }
}
</script>
@endsection