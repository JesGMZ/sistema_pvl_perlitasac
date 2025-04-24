@extends('layouts.app')

@section('title', 'Registrar Programa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('programa.mostrar') }}" class="btn btn-light me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="h3 mb-0">Registrar Nuevo Programa Vaso de Leche</h1>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('programa.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Fecha del Programa -->
                            <div class="col-md-6 mb-4">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" 
                                       class="form-control @error('fecha') is-invalid @enderror" 
                                       id="fecha" 
                                       name="fecha" 
                                       value="{{ old('fecha') }}"
                                       required>
                                @error('fecha')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Beneficiario -->
                            <div class="col-md-6 mb-4">
                                <label for="idbeneficiarios" class="form-label">Beneficiario</label>
                                <select class="form-select @error('idbeneficiarios') is-invalid @enderror" 
                                        id="idbeneficiarios" 
                                        name="idbeneficiarios" 
                                        required>
                                    <option value="">Seleccione un beneficiario</option>
                                    @foreach($beneficiarios as $beneficiario)
                                        <option value="{{ $beneficiario->idbeneficiarios }}" {{ old('idbeneficiarios') == $beneficiario->idbeneficiarios ? 'selected' : '' }}>
                                            {{ $beneficiario->nombres }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idbeneficiarios')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Comité -->
                            <div class="col-md-6 mb-4">
                                <label for="idcomite" class="form-label">Comité</label>
                                <select class="form-select @error('idcomite') is-invalid @enderror" 
                                        id="idcomite" 
                                        name="idcomite" 
                                        required>
                                    <option value="">Seleccione un comité</option>
                                    @foreach($comites as $comite)
                                        <option value="{{ $comite->idcomite }}" {{ old('idcomite') == $comite->idcomite ? 'selected' : '' }}>
                                            {{ $comite->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idcomite')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Mes -->
                            <div class="col-md-6 mb-4">
                                <label for="mes_display" class="form-label">Mes</label>
                                <input type="text" 
                                    class="form-control @error('mes') is-invalid @enderror" 
                                    id="mes_display" 
                                    value="{{ old('mes') }}"
                                    readonly
                                    style="background-color: #f1f1f1; cursor: not-allowed;">
                                
                                <input type="hidden" id="mes" name="mes" value="{{ old('mes') }}">

                                @error('mes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Programa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fechaInput = document.getElementById('fecha');
    const mesDisplay = document.getElementById('mes_display');
    const mesInput = document.getElementById('mes');


    const meses = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    fechaInput.addEventListener('change', function () {
        const fecha = new Date(this.value);
        if (!isNaN(fecha)) {
            const mesNombre = meses[fecha.getMonth()];
            mesDisplay.value = mesNombre; 
            mesInput.value = mesNombre; 
        }
    });
});
</script>

@endsection
