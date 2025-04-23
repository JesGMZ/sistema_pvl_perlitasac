<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\Municipalidad; // Asegúrate de importar el modelo
use Illuminate\Http\Request;

class ComiteController extends Controller
{
    public function registro()
    {
        $municipalidades = Municipalidad::all();
        return view('comite.registro_comite', compact('municipalidades'));
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

    public function show(Comite $comite)
    {
        //
    }

    public function edit($id)
    {
        $comite = Comite::findOrFail($id);
        $municipalidades = Municipalidad::all();
        return view('comite.editar_comite', compact('comite', 'municipalidades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'nullable|string|max:255',
            'nombre' => 'nullable|string|max:255',
            'coordinadora' => 'nullable|string|max:255',
            'idmunicipalidad' => 'required|exists:municipalidad,idmunicipalidad'
        ]);

        $comite = Comite::findOrFail($id);
        $comite->update($request->all());

        return redirect()->route('comite.mostrar')->with('success', 'Comité actualizado correctamente');
    }

    public function destroy($id)
    {
        $comite = Comite::findOrFail($id);
        $comite->delete();

        return redirect()->route('comite.mostrar')->with('success', 'Comité eliminado correctamente');
    }
}
