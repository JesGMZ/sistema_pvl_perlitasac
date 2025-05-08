@extends('layouts.app')

@section('title', 'Registrar Programa')

@section('content')

<!-- Estilos para el modal -->
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('programa.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nuevo Programa Vaso de Leche</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('programa.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Fecha del Programa -->
                            <div class="col-md-6 mb-4">
                                <label for="fecha" class="form-label">Fecha <span class="text-danger">*</span></label>
                                <input type="date" 
                                       class="form-control @error('fecha') is-invalid @enderror" 
                                       id="fecha" 
                                       name="fecha" 
                                       value="{{ old('fecha') }}"
                                       required>
                                @error('fecha')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Beneficiario -->
                            <div class="col-md-12 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <label class="form-label">Beneficiario <span class="text-danger">*</span></label>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#beneficiariosModal">
                                        <i class="fas fa-search me-1"></i> Buscar Beneficiario
                                    </button>
                                </div>
                                
                                <input type="hidden" id="idbeneficiarios" name="idbeneficiarios" required>
                                
                                <div id="beneficiario-info" class="border rounded p-3 bg-light">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nombres</label>
                                            <input type="text" class="form-control" id="nombres_beneficiario" readonly placeholder="Seleccione un beneficiario">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="apellidos_beneficiario" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="direccion_beneficiario" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Categoría</label>
                                            <input type="text" class="form-control" id="categoria_beneficiario" readonly>
                                        </div>
                                    </div>
                                </div>
                                @error('idbeneficiarios')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Comité -->
                            <div class="col-md-6 mb-4">
                                <label for="idcomite" class="form-label">Comité <span class="text-danger">*</span></label>
                                <select class="form-select @error('idcomite') is-invalid @enderror" 
                                        id="idcomite" 
                                        name="idcomite" 
                                        required>
                                    <option value="">Seleccione un comité</option>
                                    @foreach($comites as $comite)
                                        <option value="{{ $comite->idcomite }}" {{ old('idcomite') == $comite->idcomite ? 'selected' : '' }}>
                                            {{ $comite->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idcomite')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Mes -->
                            <div class="col-md-6 mb-4">
                                <label for="mes_display" class="form-label">Mes <span class="text-danger">*</span></label>
                                <input type="text" 
                                    class="form-control @error('mes') is-invalid @enderror" 
                                    id="mes_display" 
                                    value="{{ old('mes') }}"
                                    readonly>
                                
                                <input type="hidden" id="mes" name="mes" value="{{ old('mes') }}">

                                @error('mes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Guardar Programa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir jQuery y DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    // Inicializar DataTable para la tabla de beneficiarios
    var table = $('#beneficiariosTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 1 }, // Nombres
            { responsivePriority: 2, targets: 2 }, // Apellidos
            { responsivePriority: 3, targets: -1 } // Acción
        ]
    });

    // Manejar la selección de beneficiario
    $('#beneficiariosTable').on('click', '.seleccionar-beneficiario', function() {
        const id = $(this).data('id');
        const nombres = $(this).data('nombres');
        const apellidos = $(this).data('apellidos');
        const direccion = $(this).data('direccion');
        const categoria = $(this).data('categoria');

        $('#idbeneficiarios').val(id);
        $('#nombres_beneficiario').val(nombres);
        $('#apellidos_beneficiario').val(apellidos);
        $('#direccion_beneficiario').val(direccion);
        $('#categoria_beneficiario').val(categoria);

        // Cerrar el modal
        var modal = bootstrap.Modal.getInstance($('#beneficiariosModal')[0]);
        modal.hide();
    });

    // Manejar el cambio de fecha para actualizar el mes
    const meses = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    $('#fecha').on('change', function() {
        const fecha = new Date($(this).val());
        if (!isNaN(fecha)) {
            const mesNombre = meses[fecha.getMonth()];
            $('#mes_display').val(mesNombre); 
            $('#mes').val(mesNombre); 
        }
    });
    
    // Validar que se haya seleccionado un beneficiario antes de enviar el formulario
    $('form').on('submit', function(e) {
        if (!$('#idbeneficiarios').val()) {
            e.preventDefault();
            alert('Por favor seleccione un beneficiario');
            $('#beneficiariosModal').modal('show');
        }
    });
});
</script>

@endsection

@section('modales')
    @include('partials.modal_beneficiarios')
@endsection