<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use Illuminate\Http\Request;

class ComiteController extends Controller
{
    public function registro()
    {
        $municipalidades =  \App\Models\Municipalidad::all();
        return view('comite.registro_comite',compact('municipalidades'));
    }

    public function mostrar()
    {
        $comites = Comite::with('municipalidad')->get();
        return view('comite.mostrar_comite', compact('comites'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'codigo' => 'nullable|string|max:255',
            'nombre' => 'nullable|string|max:255',
            'coordinadora' => 'nullable|string|max:255',
            'idmunicipalidad' => 'required|integer|exists:municipalidad,idmunicipalidad',
        ]);

        Comite::create($request->all());

        return redirect()->back()->with('success', 'Comité registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comite $comite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comite $comite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comite $comite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comite $comite)
    {
        //
    }
}
