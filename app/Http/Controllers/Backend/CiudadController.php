<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ciudad;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CiudadStoreRequest;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ciudades = Ciudad::all();
        if($request->has('search')){
            $ciudades = Ciudad::where('nombre', 'like', "%{$request->search}%")->get();
        }
        return view('ciudades.index', compact('ciudades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Provincia::all();

        return view('ciudades.create', compact('provincias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CiudadStoreRequest $request)
    {
        Ciudad::create($request->validated());

        return redirect()->route('ciudades.index')->with('message', 'Ciudad creada de manera exitosa');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciudad $ciudad)
    {
        $provincias = Provincia::all();
        return view('ciudades.edit', compact('ciudad', 'provincias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CiudadStoreRequest $request, Ciudad $ciudad)
    {
        $ciudad->update([
            'provincia_id' => $request->provincia_id,
            'nombre' => $request->nombre
        ]);
        return redirect()->route('ciudades.index')->with('message', 'Ciudad actualizada de manera exitosa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciudad $ciudad)
    {
        $ciudad->delete();
        return redirect()->route('provincias.index')->with('message', 'Ciudad borrada de manera exitosa');
    }
}
