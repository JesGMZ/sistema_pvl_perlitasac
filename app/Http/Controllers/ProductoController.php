<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function registro()
    {
        return view('producto.registro_producto');
    }

    public function mostrar()
    {
        $productos = Producto::all();
        return view('producto.mostrar_producto', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'unidadmedida' => 'required|string|max:100',
            'marca' => 'nullable|string|max:100',
            'origen' => 'nullable|string|max:100',
            'fecha' => 'required|date',
            'cantidad' => 'required|numeric|min:0',
            'fechavencimiento' => 'nullable|date|after_or_equal:fecha',
        ]);

        Producto::create([
            'descripcion' => $request->descripcion,
            'unidadmedida' => $request->unidadmedida,
            'marca' => $request->marca,
            'origen' => $request->origen,
            'fecha' => $request->fecha,
            'cantidad' => $request->cantidad,
            'fechavencimiento' => $request->fechavencimiento,
        ]);

        return redirect()->route('productos.registro')->with('success', 'Producto registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
