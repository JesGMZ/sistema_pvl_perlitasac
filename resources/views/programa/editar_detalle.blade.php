@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Detalle del Programa</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Editar información del detalle
        </div>
        <div class="card-body">
            <form action="{{ route('detalle-programa.update', $detalle) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="pvl_id" class="form-label">Programa</label>
                    <select class="form-select @error('pvl_id') is-invalid @enderror" id="pvl_id" name="pvl_id" required>
                        @foreach($programas as $programa)
                            <option value="{{ $programa->id }}" {{ old('pvl_id', $detalle->pvl_id) == $programa->id ? 'selected' : '' }}>
                                {{ $programa->fecha }} - {{ $programa->mes }}
                            </option>
                        @endforeach
                    </select>
                    @error('pvl_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto</label>
                    <select class="form-select @error('producto_id') is-invalid @enderror" id="producto_id" name="producto_id" required>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id', $detalle->producto_id) == $producto->id ? 'selected' : '' }}>
                                {{ $producto->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" 
                        id="cantidad" name="cantidad" value="{{ old('cantidad', $detalle->cantidad) }}" required>
                    @error('cantidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" 
                        id="precio" name="precio" value="{{ old('precio', $detalle->precio) }}" required>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('detalle-programa.mostrar') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
