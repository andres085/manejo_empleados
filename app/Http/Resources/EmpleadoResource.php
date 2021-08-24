<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'apellido'=>$this->apellido,
            'nombre'=>$this->nombre,
            'nombre_medio'=>$this->nombre_medio,
            'direccion'=>$this->direccion,
            'pais'=>$this->pais,
            'provincia'=>$this->provincia,
            'ciudad'=>$this->ciudad,
            'departamento'=>$this->departamento,
            'codigo_postal' => $this->codigo_postal,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'fecha_contratacion' => $this->fecha_contratacion,
        ];
    }
}
