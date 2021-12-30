<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'apellido'=>['required'],
            'nombre'=>['required'],
            'nombre_medio'=>['required'],
            'direccion'=>['required'],
            'id_pais'=>['required'],
            'id_provincia'=>['required'],
            'id_departamento'=>['required'],
            'id_ciudad'=>['required'],
            'codigo_postal'=>['required'],
            'fecha_nacimiento'=>['required'],
            'fecha_contratacion'=>['required'],
        ];
    }
}
