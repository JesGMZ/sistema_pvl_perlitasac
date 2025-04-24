@extends('layouts.app')

@section('title', 'Registrar Municipalidad')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('municipalidad.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nueva Municipalidad</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('municipalidad.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="razonsocial" class="form-label">Razón Social</label>
                                <input type="text" 
                                       class="form-control @error('razonsocial') is-invalid @enderror" 
                                       id="razonsocial" 
                                       name="razonsocial" 
                                       value="{{ old('razonsocial') }}"
                                       placeholder="Ingrese la razón social"
                                       required>
                                @error('razonsocial')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="ruc" class="form-label">RUC</label>
                                <input type="text" 
                                       class="form-control @error('ruc') is-invalid @enderror" 
                                       id="ruc" 
                                       name="ruc" 
                                       value="{{ old('ruc') }}"
                                       placeholder="Ingrese el RUC"
                                       maxlength="11"
                                       required>
                                @error('ruc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" 
                                       class="form-control @error('direccion') is-invalid @enderror" 
                                       id="direccion" 
                                       name="direccion" 
                                       value="{{ old('direccion') }}"
                                       placeholder="Ingrese la dirección"
                                       required>
                                @error('direccion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="representante" class="form-label">Representante</label>
                                <input type="text" 
                                       class="form-control @error('representante') is-invalid @enderror" 
                                       id="representante" 
                                       name="representante" 
                                       value="{{ old('representante') }}"
                                       placeholder="Ingrese el nombre del representante"
                                       required>
                                @error('representante')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="estado" value="Vigente">

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Municipalidad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</style>
@endsection
