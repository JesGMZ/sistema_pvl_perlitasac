@extends('layouts.app')

@section('title', 'Registrar Programa')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Encabezado -->
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('programa.completo') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nuevo Programa Vaso de Leche</h1>
            </div>

            <!-- Tarjeta Principal -->
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form id="programaForm" action="{{ route('programa.store') }}" method="POST">
                        @csrf
                        
                        <!-- Sección de Información Básica -->
                        <div class="row">
                            <!-- Fecha del Programa -->
                            <div class="col-md-6 mb-4">
                                <label for="fecha" class="form-label">Fecha <span class="text-danger">*</span></label>
                                <input type="date" 
                                       class="form-control @error('fecha') is-invalid @enderror" 
                                       id="fecha" 
                                       name="fecha" 
                                       value="{{ old('fecha', now()->format('Y-m-d')) }}"
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

                            <!-- Mes (auto-generado) -->
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

                        <!-- Sección de Detalles de Entrega -->
                        <div class="col-12 mt-4">
                            <h4 class="mb-3 border-bottom pb-2">Detalles de Entrega</h4>
                            
                                <!-- Formulario para agregar detalles -->
                                <div class="card mb-4 border-primary">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Agregar Producto</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <!-- Producto -->
                                            <div class="col-md-6">
                                                <label for="idproductos" class="form-label">Producto</label>
                                                <select class="form-select" id="idproductos">
                                                    <option value="">Seleccione un producto</option>
                                                    @foreach($productos as $producto)
                                                        <option value="{{ $producto->idproductos }}" data-precio="{{ $producto->precio }}">
                                                            {{ $producto->descripcion }} (S/ {{ number_format($producto->precio, 2) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Cantidad -->
                                            <div class="col-md-3">
                                                <label for="cantidad" class="form-label">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad" step="0.01" min="0.01" value="1">
                                            </div>

                                            <!-- Precio (auto-completado) -->
                                            <div class="col-md-3">
                                                <label for="precio" class="form-label">Precio Unitario</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">S/</span>
                                                    <input type="number" class="form-control" id="precio" step="0.01" min="0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end mt-3">
                                            <button type="button" class="btn btn-primary" id="agregarDetalle">
                                                <i class="fas fa-plus me-1"></i> Agregar Producto
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            <!-- Tabla de Detalles -->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="tablaDetalles">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="40%">Producto</th>
                                            <th width="15%">Cantidad</th>
                                            <th width="15%">Precio Unitario</th>
                                            <th width="15%">Subtotal</th>
                                            <th width="15%" class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Los detalles se agregarán dinámicamente aquí -->
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Total:</td>
                                            <td colspan="2" class="fw-bold" id="totalGeneral">S/ 0.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-eraser me-1"></i> Limpiar
                            </button>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Guardar Programa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modales')
    @include('partials.modal_beneficiarios')
@endsection

@section('scripts')
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

    // Auto-completar mes al cambiar fecha
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
    }).trigger('change'); // Ejecutar al cargar la página

    // Auto-completar precio al seleccionar producto
    $('#idproductos').on('change', function() {
        const precio = $(this).find(':selected').data('precio');
        if (precio) {
            $('#precio').val(parseFloat(precio).toFixed(2));
        }
    });

    // Variable para llevar el índice de los detalles
    let detalleIndex = 0;

    // Manejar la adición de detalles
    $('#agregarDetalle').on('click', function() {
        const productoSelect = $('#idproductos');
        const producto = productoSelect.find('option:selected');
        const cantidad = parseFloat($('#cantidad').val());
        const precio = parseFloat($('#precio').val());

        // Validaciones
        if (!producto.val()) {
            alert('Por favor seleccione un producto');
            productoSelect.focus();
            return;
        }

        if (isNaN(cantidad) || cantidad <= 0) {
            alert('Por favor ingrese una cantidad válida');
            $('#cantidad').focus();
            return;
        }

        if (isNaN(precio) || precio <= 0) {
            alert('Por favor ingrese un precio válido');
            $('#precio').focus();
            return;
        }

        const subtotal = (cantidad * precio).toFixed(2);
        const productoText = producto.text().split(' (S/')[0]; // Remover el precio del texto

        const fila = `
            <tr data-index="${detalleIndex}">
                <td>
                    ${productoText}
                    <input type="hidden" name="productos[${detalleIndex}][idproductos]" value="${producto.val()}">
                </td>
                <td>
                    ${cantidad}
                    <input type="hidden" name="productos[${detalleIndex}][cantidad]" value="${cantidad}">
                </td>
                <td>
                    S/ ${precio.toFixed(2)}
                    <input type="hidden" name="productos[${detalleIndex}][precio]" value="${precio}">
                </td>
                <td>S/ ${subtotal}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm eliminarDetalle" title="Eliminar">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        `;

        $('#tablaDetalles tbody').append(fila);
        actualizarTotal();
        detalleIndex++;

        // Limpiar campos y resetear
        productoSelect.val('');
        $('#cantidad').val('1');
        $('#precio').val('');
        productoSelect.focus();
    });

    // Eliminar detalle
    $(document).on('click', '.eliminarDetalle', function() {
        $(this).closest('tr').remove();
        actualizarTotal();
    });

    // Actualizar total general
    function actualizarTotal() {
        let total = 0;
        $('#tablaDetalles tbody tr').each(function() {
            const subtotal = parseFloat($(this).find('td:eq(3)').text().replace('S/ ', ''));
            total += subtotal;
        });
        $('#totalGeneral').text(`S/ ${total.toFixed(2)}`);
    }

    // Validar formulario antes de enviar
    $('#programaForm').on('submit', function(e) {
        // Validar beneficiario
        if (!$('#idbeneficiarios').val()) {
            e.preventDefault();
            alert('Por favor seleccione un beneficiario');
            $('#beneficiariosModal').modal('show');
            return;
        }

        // Validar que haya al menos un detalle
        if ($('#tablaDetalles tbody tr').length === 0) {
            e.preventDefault();
            alert('Por favor agregue al menos un producto al detalle de entrega');
            return;
        }
    });
});
</script>
@endsection