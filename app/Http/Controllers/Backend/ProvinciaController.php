<?php

namespace App\Http\Controllers\Backend;

use App\Models\Pais;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinciaStoreRequest;

class ProvinciaController extends Controller
{
    public function index(Request $request)
    {
        $provincias = Provincia::all();
        if($request->has('search')){
            $provincias = Provincia::where('nombre', 'like', "%{$request->search}%")->get();
        }
        return view('provincias.index', compact('provincias'));
    }

    public function create()
    {
        $paises = Pais::all();
        return view('provincias.create', compact('paises'));
    }

    public function store(ProvinciaStoreRequest $request)
    {
        Provincia::create($request->validated());

        return redirect()->route('provincias.index')->with('message', 'Provincia creada de manera exitosa');
    }

    public function edit(Provincia $provincia)
    {
        $paises = Pais::all();
        return view('provincias.edit', compact('provincia', 'paises'));
    }

    public function update(ProvinciaStoreRequest $request, Provincia $provincia)
    {
        $provincia->update([
            'pais_id' => $request->pais_id,
            'nombre' => $request->nombre
        ]);

        return redirect()->route('provincias.index')->with('message', 'Provincia actualizada de manera exitosa');
    }

    public function destroy(Provincia $provincia)
    {
        $provincia->delete();
        return redirect()->route('provincias.index')->with('message', 'Provincia borrada de manera exitosa');
    }
}
