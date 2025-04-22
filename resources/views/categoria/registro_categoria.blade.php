@extends('layouts.app')

@section('title', 'Registrar Categoría')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Registrar Nueva Categoría</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categoria.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="descategoria" class="form-label">Descripción de la Categoría</label>
                            <input type="text" 
                                   class="form-control @error('descategoria') is-invalid @enderror" 
                                   id="descategoria" 
                                   name="descategoria" 
                                   value="{{ old('descategoria') }}"
                                   required>
                            @error('descategoria')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categoria.mostrar') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Volver
                            </a>
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
@endsection
