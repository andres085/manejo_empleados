<?php

namespace App\Http\Controllers\Backend;

use App\Models\Pais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaisStoreRequest;

class PaisController extends Controller
{

    public function index(Request $request)
    {
        $paises = Pais::all();
          if($request->has('search')){
            $paises = Pais::where('codigo_pais', 'like', "%{$request->search}%")->orWhere('nombre', 'like', "%{$request->search}%")->get();
        }
        return view('paises.index', compact('paises'));
    }

    public function create()
    {
        return view('paises.create');
    }

    public function store(PaisStoreRequest $request)
    {
        Pais::create($request->validated());

        return redirect()->route('paises.index')->with('message', 'País creado de manera exitosa');
    }
}
