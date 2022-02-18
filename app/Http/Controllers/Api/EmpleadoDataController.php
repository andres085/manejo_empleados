<?php

namespace App\Http\Controllers\Api;

use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpleadoDataController extends Controller
{
    public function paises()
    {
        $paises = Pais::all();
        return response()->json($paises, 200);
    }

    public function provincias(Pais $pais)
    {
        return response()->json($pais->provincias, 200);
    }

    public function ciudades(Provincia $provincia)
    {
        return response()->json($provincia->ciudades, 200);
    }

    public function departamentos()
    {
        $departamentos = Departamento::all();
        return response()->json($departamentos, 200);
    }
}
