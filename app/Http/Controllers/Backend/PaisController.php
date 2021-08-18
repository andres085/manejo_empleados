<?php

namespace App\Http\Controllers\Backend;

use App\Models\Pais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaisController extends Controller
{

    public function index()
    {
        $paises = Pais::all();
        return view('paises.index', compact('paises'));
    }
}
