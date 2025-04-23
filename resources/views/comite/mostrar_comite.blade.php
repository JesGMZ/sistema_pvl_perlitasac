@extends('layouts.app')

@section('title', 'Comités')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Comités</h1>
        <a href="{{ route('comite.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo Comité
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Coordinadora</th>
                            <th scope="col">Municipalidad</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comites as $comite)
                            <tr>
                                <td>{{ $comite->codigo ?? '—' }}</td>
                                <td>{{ $comite->nombre ?? '—' }}</td>
                                <td>{{ $comite->coordinadora ?? '—' }}</td>
                                <td>{{ $comite->municipalidad->razonsocial ?? '—' }}</td>

                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('comite.edit', $comite) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('comite.destroy', $comite) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" 
                                                onclick="return confirm('¿Está seguro que desea eliminar este comité?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-3 text-muted">
                                    No hay comités registrados
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
