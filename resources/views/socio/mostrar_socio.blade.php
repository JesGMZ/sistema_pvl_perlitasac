@extends('layouts.app')

@section('title', 'Socios')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Socios</h1>
        <a href="{{ route('socio.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo Socio
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">DNI</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Dirección</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($socios as $socio)
                            <tr>
                                <td>{{ $socio->dni }}</td>
                                <td>{{ $socio->nombres }}</td>
                                <td>{{ $socio->apellidos }}</td>
                                <td>{{ $socio->sexo }}</td>
                                <td>{{ \Carbon\Carbon::parse($socio->fechanacimiento)->format('d/m/Y') }}</td>
                                <td>{{ $socio->edad }} años</td>
                                <td>{{ $socio->direccion ?? 'N/A' }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="#" class="btn btn-info btn-sm" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="#" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este socio?');">
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
                                    No hay socios registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-sm {
        padding: 0.4rem;
        line-height: 1;
        border-radius: 4px;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.8em;
    }
    
    .table > :not(caption) > * > * {
        padding: 1rem;
    }
    
    .table thead th {
        background-color: #f8f9fa;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
    }
</style>
@endsection
