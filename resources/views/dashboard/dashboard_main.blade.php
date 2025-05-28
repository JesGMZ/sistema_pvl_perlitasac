@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Dashboard</h1>
                <!-- Selector para reportes -->
                <div class="input-group" style="width: auto;">
                    <select class="form-select" id="mesSelect">
                        <option value="">Mes</option>
                        @foreach($availableMonths as $month)
                            <option value="{{ $month['value'] }}">{{ $month['label'] }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" onclick="generarReporte()">Generar Reporte</button>
                </div>

                <script>
                    function generarReporte() {
                        const mes = document.getElementById('mesSelect').value;
                        if (mes) {
                            window.location.href = `/dashboard/reporte/${mes}`;
                        } else {
                            alert('Por favor, selecciona un mes.');
                        }
                    }
                </script>

            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        @php
            $stats = [
                [
                    'label' => 'Total Beneficiarios',
                    'value' => $totalBeneficiarios,
                    'icon' => 'users',
                    'color' => 'primary',
                    'growth' => $beneficiariosGrowth
                ],
                [
                    'label' => 'Distribución Mensual',
                    'value' => number_format($totalDistribucion, 1) . ' kg',
                    'icon' => 'box',
                    'color' => 'success',
                    'growth' => $distribucionGrowth
                ],
                [
                    'label' => 'Comités Activos',
                    'value' => $comitesActivos,
                    'icon' => 'home',
                    'color' => 'info',
                    'growth' => $comitesGrowth
                ],
                [
                    'label' => 'Alertas Stock Bajo',
                    'value' => $stockBajo,
                    'icon' => 'exclamation-triangle',
                    'color' => 'warning',
                    'growth' => $alertasGrowth
                ],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">{{ $stat['label'] }}</div>
                                <h3 class="mb-0">{{ $stat['value'] }}</h3>
                            </div>
                            <div class="rounded-circle bg-{{ $stat['color'] }} bg-opacity-10 p-3">
                                <i class="fas fa-{{ $stat['icon'] }} text-{{ $stat['color'] }}"></i>
                            </div>
                        </div>
                        @if($stat['growth'] > 0)
                            <div class="small mt-2 text-success">
                                <i class="fas fa-arrow-up"></i> {{ number_format($stat['growth'], 1) }}% desde el mes pasado
                            </div>
                        @elseif($stat['growth'] < 0)
                            <div class="small mt-2 text-danger">
                                <i class="fas fa-arrow-down"></i> {{ number_format(abs($stat['growth']), 1) }}% desde el mes pasado
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4">
        <!-- Distribución -->
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Distribución</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary active" data-view="porComite">Por Comité</button>
                            <button type="button" class="btn btn-outline-primary" data-view="tendencia">Tendencia</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="viewPorComite">
                        <div class="mb-3 d-flex gap-2 justify-content-end">
                            <select class="form-select form-select-sm" id="filterComite" style="width: auto;">
                                <option value="">Todos los Comités</option>
                                @foreach($comites as $comite)
                                    <option value="{{ $comite->idcomite }}">{{ $comite->nombre }}</option>
                                @endforeach
                            </select>
                            <select class="form-select form-select-sm" id="filterPvl" style="width: auto;">
                                <option value="">Seleccione PVL</option>
                                @foreach($pvls as $pvl)
                                    <option value="{{ $pvl->idpvl }}" data-comite="{{ $pvl->idcomite }}">{{ \Carbon\Carbon::parse($pvl->fecha)->format('d/m/Y') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="height: 250px;">
                            <canvas id="entregasChart"></canvas>
                        </div>
                    </div>
                    <div id="viewTendencia" style="display: none;">
                        <!-- Aquí va el contenido de la vista Tendencia -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos para el gráfico
        const entregasData = @json($entregasData);
        
        // Configuración del gráfico
        const ctx = document.getElementById('entregasChart').getContext('2d');
        const entregasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: entregasData.labels,
                datasets: [{
                    label: 'Cantidad de Entregas',
                    data: entregasData.values,
                    backgroundColor: '#0d6efd',
                    borderRadius: 4,
                    barPercentage: 0.4, // Ajusta el ancho de las barras
                    categoryPercentage: 0.7 // Ajusta el espacio entre grupos de barras
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        title: {
                            display: true,
                            text: 'Conteo de Entregas'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Cantidad (lt)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20
                    }
                }
            }
        });

        // Evento para el filtro de comités
        document.getElementById('filterComite').addEventListener('change', function(e) {
            const comiteId = e.target.value;
            const pvlSelect = document.getElementById('filterPvl');
            
            // Mostrar/ocultar opciones de PVL según el comité seleccionado
            Array.from(pvlSelect.options).forEach(option => {
                if (!comiteId || option.value === '') {
                    option.style.display = '';
                } else {
                    option.style.display = option.dataset.comite === comiteId ? '' : 'none';
                }
            });

            // Resetear selección de PVL
            pvlSelect.value = '';

            // Actualizar gráfico con datos del comité
            actualizarGrafico(comiteId);
        });

        // Evento para el filtro de PVL
        document.getElementById('filterPvl').addEventListener('change', function(e) {
            const comiteId = document.getElementById('filterComite').value;
            const pvlId = e.target.value;
            actualizarGrafico(comiteId, pvlId);
        });

        function actualizarGrafico(comiteId, pvlId = null) {
            let url = '/dashboard/entregas-data?';
            if (comiteId) url += `idcomite=${comiteId}&`;
            if (pvlId) url += `idpvl=${pvlId}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    entregasChart.data.labels = data.labels;
                    entregasChart.data.datasets[0].data = data.values;
                    entregasChart.update();
                });
        }

        // Cambio entre vistas
        document.querySelectorAll('[data-view]').forEach(button => {
            button.addEventListener('click', function() {
                const view = this.dataset.view;
                
                // Actualizar botones
                document.querySelectorAll('[data-view]').forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-outline-primary');
                });
                this.classList.add('active');
                this.classList.add('btn-primary');
                this.classList.remove('btn-outline-primary');
                
                // Mostrar vista seleccionada
                document.getElementById('viewPorComite').style.display = view === 'porComite' ? 'block' : 'none';
                document.getElementById('viewTendencia').style.display = view === 'tendencia' ? 'block' : 'none';
            });
        });
    </script>
@endsection