@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('producto.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Editar Producto</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('producto.update', $producto->idproductos) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Descripción -->
                            <div class="col-md-12 mb-4">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text"
                                       class="form-control @error('descripcion') is-invalid @enderror"
                                       id="descripcion"
                                       name="descripcion"
                                       value="{{ old('descripcion', $producto->descripcion) }}"
                                       placeholder="Ingrese descripción del producto"
                                       required>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Unidad de Medida -->
                            <div class="col-md-6 mb-4">
                                <label for="unidadmedida" class="form-label">Unidad de Medida</label>
                                <input type="text"
                                       class="form-control @error('unidadmedida') is-invalid @enderror"
                                       id="unidadmedida"
                                       name="unidadmedida"
                                       value="{{ old('unidadmedida', $producto->unidadmedida) }}"
                                       placeholder="Ej: KG, L, UND"
                                       required>
                                @error('unidadmedida')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Marca -->
                            <div class="col-md-6 mb-4">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text"
                                       class="form-control @error('marca') is-invalid @enderror"
                                       id="marca"
                                       name="marca"
                                       value="{{ old('marca', $producto->marca) }}"
                                       placeholder="Ingrese la marca (opcional)">
                                @error('marca')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Origen -->
                            <div class="col-md-6 mb-4">
                                <label for="origen" class="form-label">Origen</label>
                                <input type="text"
                                       class="form-control @error('origen') is-invalid @enderror"
                                       id="origen"
                                       name="origen"
                                       value="{{ old('origen', $producto->origen) }}"
                                       placeholder="Ingrese el origen (opcional)">
                                @error('origen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fecha de Registro -->
                            <div class="col-md-6 mb-4">
                                <label for="fecha" class="form-label">Fecha de Registro</label>
                                <input type="date"
                                       class="form-control @error('fecha') is-invalid @enderror"
                                       id="fecha"
                                       name="fecha"
                                       value="{{ old('fecha', $producto->fecha) }}"
                                       required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Cantidad -->
                            <div class="col-md-6 mb-4">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number"
                                       class="form-control @error('cantidad') is-invalid @enderror"
                                       id="cantidad"
                                       name="cantidad"
                                       value="{{ old('cantidad', $producto->cantidad) }}"
                                       min="0"
                                       step="any"
                                       required>
                                @error('cantidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fecha de Vencimiento -->
                            <div class="col-md-6 mb-4">
                                <label for="fechavencimiento" class="form-label">Fecha de Vencimiento</label>
                                <input type="date"
                                       class="form-control @error('fechavencimiento') is-invalid @enderror"
                                       id="fechavencimiento"
                                       name="fechavencimiento"
                                       value="{{ old('fechavencimiento', $producto->fechavencimiento) }}">
                                @error('fechavencimiento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('producto.mostrar') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .form-control, .form-select {
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.1);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: var(--danger);
    }

    textarea.form-control {
        min-height: 100px;
    }

    .btn-light {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }

    .btn-light:hover {
        background-color: #e9ecef;
        border-color: #e9ecef;
    }
</style>
@endsection
