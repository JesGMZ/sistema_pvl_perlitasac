@extends('layouts.app')

@section('title', 'Registrar Producto')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('producto.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nuevo Producto</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('producto.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text"
                                       class="form-control @error('descripcion') is-invalid @enderror"
                                       id="descripcion"
                                       name="descripcion"
                                       value="{{ old('descripcion') }}"
                                       placeholder="Ingrese la descripción"
                                       required>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="unidadmedida" class="form-label">Unidad de Medida</label>
                                <input type="text"
                                       class="form-control @error('unidadmedida') is-invalid @enderror"
                                       id="unidadmedida"
                                       name="unidadmedida"
                                       value="{{ old('unidadmedida') }}"
                                       placeholder="Ej. unidades, kg, litros"
                                       required>
                                @error('unidadmedida')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text"
                                       class="form-control @error('marca') is-invalid @enderror"
                                       id="marca"
                                       name="marca"
                                       value="{{ old('marca') }}"
                                       placeholder="Ingrese la marca"
                                       required>
                                @error('marca')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="origen" class="form-label">Origen</label>
                                <input type="text"
                                       class="form-control @error('origen') is-invalid @enderror"
                                       id="origen"
                                       name="origen"
                                       value="{{ old('origen') }}"
                                       placeholder="Ej. nacional, importado"
                                       required>
                                @error('origen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="fecha" class="form-label">Fecha de Registro</label>
                                <input type="date"
                                       class="form-control @error('fecha') is-invalid @enderror"
                                       id="fecha"
                                       name="fecha"
                                       value="{{ old('fecha') }}"
                                       required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number"
                                       class="form-control @error('cantidad') is-invalid @enderror"
                                       id="cantidad"
                                       name="cantidad"
                                       value="{{ old('cantidad', 0) }}"
                                       min="0"
                                       required>
                                @error('cantidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="fechavencimiento" class="form-label">Fecha de Vencimiento</label>
                                <input type="date"
                                       class="form-control @error('fechavencimiento') is-invalid @enderror"
                                       id="fechavencimiento"
                                       name="fechavencimiento"
                                       value="{{ old('fechavencimiento') }}"
                                       required>
                                @error('fechavencimiento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
