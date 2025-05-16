@extends('layouts.app')

@section('title', 'Registro de Detalle')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('programa.completo') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Entrega</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('detalle-programa.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Programa -->
                            <div class="col-md-6 mb-4">
                                <label for="idpvl" class="form-label">Programa</label>
                                <select class="form-select @error('idpvl') is-invalid @enderror" 
                                        id="idpvl" 
                                        name="idpvl" 
                                        required>
                                    <option value="">Seleccione un programa</option>
                                    @foreach($pvls as $pvl)
                                        <option value="{{ $pvl->idpvl }}" {{ old('idpvl') == $pvl->idpvl ? 'selected' : '' }}>
                                            {{ $pvl->fecha }} - {{ $pvl->mes }} - {{ $pvl->comite->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idpvl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Producto -->
                            <div class="col-md-6 mb-4">
                                <label for="idproductos" class="form-label">Producto</label>
                                <select class="form-select @error('idproductos') is-invalid @enderror" 
                                        id="idproductos" 
                                        name="idproductos" 
                                        required>
                                    <option value="">Seleccione un producto</option>
                                    @foreach($productos as $producto)
                                        <option value="{{ $producto->idproductos }}" {{ old('idproductos') == $producto->idproductos ? 'selected' : '' }}>
                                            {{ $producto->descripcion }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idproductos')
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
                                       value="{{ old('cantidad') }}"
                                       step="0.01"
                                       min="0"
                                       required>
                                @error('cantidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Precio -->
                            <div class="col-md-6 mb-4">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" 
                                       class="form-control @error('precio') is-invalid @enderror" 
                                       id="precio" 
                                       name="precio" 
                                       value="{{ old('precio') }}"
                                       step="0.01"
                                       min="0"
                                       required>
                                @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('detalle-programa.mostrar') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar
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
