@extends('layouts.app')

@section('title', 'Registrar Categoría')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('categoria.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nueva Categoría</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('categoria.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="descategoria" class="form-label">
                                Descripción de la Categoría
                            </label>
                            <input type="text" 
                                   class="form-control @error('descategoria') is-invalid @enderror" 
                                   id="descategoria" 
                                   name="descategoria" 
                                   value="{{ old('descategoria') }}"
                                   placeholder="Ingrese la descripción de la categoría"
                                   required>
                            @error('descategoria')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
