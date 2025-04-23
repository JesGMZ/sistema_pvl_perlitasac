<?php

namespace App\Http\Controllers;

use App\Models\Detallepvl;
use App\Models\Pvl;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleProgramaController extends Controller
{
    public function registro()
    {
        $pvls = Pvl::where('estado', 'Vigente')->get();
        $productos = Producto::all();
        return view('detalle.registro_detalle', compact('pvls', 'productos'));
    }

    public function mostrar()
    {
        $detalles = Detallepvl::with(['pvl', 'producto'])->get();
        return view('detalle.mostrar_detalle', compact('detalles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0',
            'idproductos' => 'required|exists:productos,idproductos',
            'idpvl' => 'required|exists:pvl,idpvl'
        ]);

        Detallepvl::create($request->all());
        return redirect()->route('detalle-programa.mostrar')->with('success', 'Entrega registrado correctamente');
    }

    public function edit(Detallepvl $detalle)
    {
        $pvls = Pvl::where('estado', 'Vigente')->get();
        $productos = Producto::all();
        return view('detalle.editar_detalle', compact('detalle', 'pvls', 'productos'));
    }

    public function update(Request $request, Detallepvl $detalle)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0',
            'idproductos' => 'required|exists:productos,idproductos',
            'idpvl' => 'required|exists:pvl,idpvl'
        ]);

        $detalle->update($request->all());
        return redirect()->route('detalle-programa.mostrar')->with('success', 'Entrega actualizado correctamente');
    }

    public function destroy(Detallepvl $detalle)
    {
        $detalle->delete();
        return redirect()->route('detalle-programa.mostrar')->with('success', 'Entrega eliminado correctamente');
    }
}
