
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Programa</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->pvl->fecha }} - {{ $detalle->pvl->mes }}</td>
                                <td>{{ $detalle->producto->descripcion }}</td>
                                <td>{{ $detalle->cantidad }} {{ $detalle->producto->unidadmedida }}</td>
                                <td>S/ {{ number_format($detalle->precio, 2) }}</td>
                                <td>S/ {{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('detalle-programa.edit', $detalle->iddetallepvl) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('detalle-programa.destroy', $detalle->iddetallepvl) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta entrega?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-3 text-muted">
                                    No hay detalles registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
