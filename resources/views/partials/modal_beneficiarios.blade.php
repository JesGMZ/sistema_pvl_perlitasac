<!-- Modal para selección de beneficiarios -->
<div class="modal fade" id="beneficiariosModal" tabindex="-1" aria-labelledby="beneficiariosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="beneficiariosModalLabel">Seleccionar Beneficiario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="beneficiariosTable" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Dirección</th>
                                <th>Categoría</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beneficiarios as $beneficiario)
                            <tr>
                                <td>{{ $beneficiario->idbeneficiarios }}</td>
                                <td>{{ $beneficiario->nombres }}</td>
                                <td>{{ $beneficiario->apellidos }}</td>
                                <td>{{ $beneficiario->direccion }}</td>
                                <td>{{ $beneficiario->categoria->descategoria ?? 'Sin categoría' }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm seleccionar-beneficiario"
                                        data-id="{{ $beneficiario->idbeneficiarios }}"
                                        data-nombres="{{ $beneficiario->nombres }}"
                                        data-apellidos="{{ $beneficiario->apellidos }}"
                                        data-direccion="{{ $beneficiario->direccion }}"
                                        data-categoria="{{ $beneficiario->categoria->descategoria ?? '' }}">
                                        <i class="fas fa-check me-1"></i> Seleccionar
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
