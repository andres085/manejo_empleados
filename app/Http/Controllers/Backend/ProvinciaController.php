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
        return view('provincia.edit', compact('provincia'));
    }
    
}
