<?php

namespace App\Models;

use App\Models\Pais;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provincia extends Model
{
    use HasFactory;

    protected $table = "provincias";

    protected $fillable = [
        'pais_id', 'nombre'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

}
