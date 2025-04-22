<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function registro()
    {
        return view('categoria.registro_categoria');
    }

    public function mostrar()
    {
        $categorias = Categoria::where('estado', 'Vigente')->get();
        return view('categoria.mostrar_categoria', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descategoria' => 'required|string|max:255'
        ]);

        Categoria::create([
            'descategoria' => $request->descategoria,
            'estado' => 'Vigente',
        ]);

        return redirect()->route('categoria.registro')->with('success', 'Categoría registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
