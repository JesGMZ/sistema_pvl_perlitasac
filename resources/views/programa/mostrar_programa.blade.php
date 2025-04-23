@extends('layouts.app')

@section('title', 'Registros Vaso de Leche')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Registros del Programa Vaso de Leche</h1>
        <a href="{{ route('programa.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo Registro
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Mes</th>
                            <th scope="col">Beneficiario</th>
                            <th scope="col">Comité</th>
                            <th scope="col">Estado</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pvls as $pvl)
                            <tr>
                                <td>{{ $pvl->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($pvl->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $pvl->mes }}</td>
                                <td>{{ $pvl->beneficiario->nombres ?? 'No asignado' }}</td>
                                <td>{{ $pvl->comite->nombre ?? 'No asignado' }}</td>
                                <td>
                                    <span class="badge bg-{{ $pvl->estado == 'Vigente' ? 'success' : 'secondary' }} rounded-pill">
                                        {{ $pvl->estado }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-info btn-sm" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-3 text-muted">
                                    No hay registros disponibles
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
