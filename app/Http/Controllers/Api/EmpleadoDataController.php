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
        return response()->json($paises);
    }

    public function provincias(Pais $pais)
    {
        return response()->json($pais->provincias);
    }

    public function ciudades(Provincia $provincia)
    {
        return response()->json($provincia->ciudades);
    }

    public function departamentos()
    {
        $departamentos = Departamento::all();
        return response()->json($departamentos);
    }
}
