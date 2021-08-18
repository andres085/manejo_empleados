<?php

namespace App\Http\Controllers\Backend;

use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinciaController extends Controller
{
    public function index(Request $request)
    {
        $provincias = Provincia::all();
        return view('provincias.index', compact('provincias'));
    }
}
