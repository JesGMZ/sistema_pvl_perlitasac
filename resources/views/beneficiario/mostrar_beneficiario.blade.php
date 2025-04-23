@extends('layouts.app')

@section('title', 'Beneficiarios')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Beneficiarios</h1>
        <a href="{{ route('beneficiario.registro') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo Beneficiario
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Parentesco</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Socio</th>
                            <th scope="col">Fecha Nac.</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Estado</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beneficiarios as $beneficiario)
                            <tr>
                                <td>{{ $beneficiario->id }}</td>
                                <td>{{ $beneficiario->nombres }}</td>
                                <td>{{ $beneficiario->apellidos }}</td>
                                <td>{{ $beneficiario->direccion }}</td>
                                <td>{{ $beneficiario->parentesco }}</td>
                                <td>{{ $beneficiario->sexo }}</td>
                                <td>{{ $beneficiario->categoria->descategoria ?? 'Sin categoría' }}</td>
                                <td>{{ $beneficiario->socio->nombres ?? 'Sin socio' }}</td>
                                <td>{{ \Carbon\Carbon::parse($beneficiario->fechanacimiento)->format('d/m/Y') }}</td>
                                <td>{{ $beneficiario->edad }}</td>
                                <td>
                                    <span class="badge bg-{{ $beneficiario->estado == 'Vigente' ? 'success' : 'secondary' }} rounded-pill">
                                        {{ $beneficiario->estado }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('beneficiario.edit', $beneficiario) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('beneficiario.destroy', $beneficiario) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" 
                                                onclick="return confirm('¿Está seguro que desea eliminar este beneficiario?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center py-3 text-muted">
                                    No hay beneficiarios registrados
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
