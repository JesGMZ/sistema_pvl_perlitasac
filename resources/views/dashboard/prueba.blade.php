
@extends('layouts.app') 

@section('title', 'Bienvenido')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-body text-center py-5">
            <h2 class="mb-3 fw-bold text-primary">Bienvenido al Programa Vaso de Leche</h2>
            <p class="text-muted mb-4">
                Gracias por formar parte del sistema. Desde aquí podrás gestionar la distribución, los beneficiarios y el seguimiento del programa.
            </p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 shadow">
                Ir al Panel Principal
            </a>
        </div>
    </div>
</div>
@endsection
