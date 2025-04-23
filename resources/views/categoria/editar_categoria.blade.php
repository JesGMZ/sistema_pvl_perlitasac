@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Categoría</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Editar información de la categoría
        </div>
        <div class="card-body">
            <form action="{{ route('categoria.update', $categoria) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="descategoria" class="form-label">Descripción</label>
                    <input type="text" class="form-control @error('descategoria') is-invalid @enderror" 
                        id="descategoria" name="descategoria" value="{{ old('descategoria', $categoria->descategoria) }}" required>
                    @error('descategoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                        <option value="1" {{ old('estado', $categoria->estado) == 1 ? 'selected' : '' }}>Vigente</option>
                        <option value="0" {{ old('estado', $categoria->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('categoria.mostrar') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
