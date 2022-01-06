<?php

namespace App\Http\Controllers\Api;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmpleadoResource;
use App\Http\Requests\EmpleadoStoreRequest;
use App\Http\Resources\EmpleadoSingleResource;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $empleados = Empleado::all();
        if ($request->search) {
            $empleados = Empleado::where('nombre', 'like', "%{$request->search}%")->orWhere('apellido', 'like', "%{$request->search}%")->get();
        } elseif ($request->id_departamento) {
            $empleados = Empleado::where('id_departamento', $request->id_departamento)->get();
        }

        return EmpleadoResource::collection($empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoStoreRequest $request)
    {
        $empleado = Empleado::create($request->validated());

        return response()->json($empleado);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        return new EmpleadoSingleResource($empleado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoStoreRequest $request, Empleado $empleado)
    {
        $empleado->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return response()->json('Empleado borrado con exito');
    }
}
