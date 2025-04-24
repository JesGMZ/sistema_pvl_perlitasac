@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Productos</h1>
        <link rel="stylesheet" href="{{ asset('css/formone.css') }}">
        <a href="{{ route('producto.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo Producto
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Unidad</th>
                            <th>Marca</th>
                            <th>Origen</th>
                            <th>Fecha Registro</th>
                            <th>Vencimiento</th>
                            <th>Cantidad</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                            <tr>
                                <td>{{ $producto->descripcion }}</td>
                                <td>{{ $producto->unidadmedida }}</td>
                                <td>{{ $producto->marca }}</td>
                                <td>{{ $producto->origen }}</td>
                                <td>{{ $producto->fecha }}</td>
                                <td>{{ $producto->fechavencimiento }}</td>
                                <td>{{ $producto->cantidad }}</td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">

                                        <a href="{{ route('producto.edit', $producto->idproductos) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('producto.destroy', $producto->idproductos) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
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
                                <td colspan="9" class="text-center py-3 text-muted">
                                    No hay productos registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
