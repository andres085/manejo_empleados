<?php

namespace App\Models;

use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pais extends Model
{
    use HasFactory;

    protected $table = "paises";

    protected $fillable = ['codigo_pais', 'nombre'];

    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }
}
