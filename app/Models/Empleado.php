<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = ['apellido', 'nombre', 'nombre_medio', 'direccion', 'id_pais', 'id_provincia', 'id_departamento', 'id_ciudad', 'codigo_postal', 'fecha_nacimiento', 'fecha_contratacion'];
}
