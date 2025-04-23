<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Comite;
use App\Models\Detallepvl;
use App\Models\Producto;
use App\Models\Pvl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de beneficiarios vigentes y crecimiento
        $totalBeneficiarios = Beneficiario::where('estado', 'Vigente')->count();
        // Simplificamos el cálculo para mostrar un crecimiento fijo por ahora
        $beneficiariosGrowth = 5.3;

        // Distribución mensual actual
        $now = Carbon::now();
        $currentMonthDetalles = Detallepvl::whereHas('pvl', fn($query) =>
            $query->whereMonth('fecha', $now->month)->whereYear('fecha', $now->year)
        )->get();
        $totalDistribucion = $currentMonthDetalles->sum('cantidad');

        // Distribución del mes anterior
        $lastMonth = $now->copy()->subMonth();
        $lastMonthDetalles = Detallepvl::whereHas('pvl', fn($query) =>
            $query->whereMonth('fecha', $lastMonth->month)->whereYear('fecha', $lastMonth->year)
        )->get();
        $lastMonthDistribucion = $lastMonthDetalles->sum('cantidad');

        $distribucionGrowth = $lastMonthDistribucion > 0
            ? (($totalDistribucion - $lastMonthDistribucion) / $lastMonthDistribucion) * 100
            : 2.1; // Valor por defecto para la demo

        // Comités activos
        $comitesActivos = Comite::count();
        // No hay cambio en comités
        $comitesGrowth = 0;

        // Alertas de stock bajo
        $stockBajo = Producto::where('cantidad', '<=', 30)->count();
        // Simulamos 2 alertas menos que el mes pasado
        $alertasGrowth = -2;

        // Actividad reciente
        $recentActivity = collect([
            [
                'type' => 'beneficiario',
                'message' => 'Registro nuevo beneficiario',
                'user' => 'María López',
                'date' => now()->subMinutes(10)
            ],
            [
                'type' => 'inventario',
                'message' => 'Actualización de inventario',
                'user' => 'Juan Pérez',
                'date' => now()->subMinutes(25)
            ],
            [
                'type' => 'alerta',
                'message' => 'Alerta: Stock bajo de leche',
                'user' => 'Sistema',
                'date' => now()->subHour()
            ],
            [
                'type' => 'eliminacion',
                'message' => 'Eliminación de registro duplicado',
                'user' => 'Admin',
                'date' => now()->subHours(2)
            ]
        ])->sortByDesc('date')->values();

        return view('dashboard.dashboard_main', compact(
            'totalBeneficiarios',
            'beneficiariosGrowth',
            'totalDistribucion',
            'distribucionGrowth',
            'comitesActivos',
            'comitesGrowth',
            'stockBajo',
            'alertasGrowth',
            'recentActivity'
        ));
    }

    public function generarReporte(Request $request)
    {
        $fecha = Carbon::createFromFormat('Y-m', $request->mes);

        $detalles = Detallepvl::with(['pvl.comite', 'producto'])
            ->whereHas('pvl', fn($query) => 
                $query->whereMonth('fecha', $fecha->month)->whereYear('fecha', $fecha->year)
            )->get();

        $resumenComites = $detalles->groupBy('pvl.comite.nombre')
            ->map(fn($comiteItems) => [
                'total_cantidad' => $comiteItems->sum('cantidad'),
                'productos' => $comiteItems->groupBy('producto.descripcion')
                    ->map(fn($prodItems) => [
                        'cantidad' => $prodItems->sum('cantidad'),
                        'unidad' => $prodItems->first()->producto->unidadmedida
                    ])
            ]);

        $data = [
            'fecha' => $fecha->isoFormat('MMMM YYYY'),
            'total_distribuido' => $detalles->sum('cantidad'),
            'total_comites' => $resumenComites->count(),
            'resumen_comites' => $resumenComites
        ];

        $pdf = PDF::loadView('reportes.mensual', $data);
        return $pdf->download('reporte-' . $fecha->format('Y-m') . '.pdf');
    }
}
