<?php

namespace App\Models;

use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = "ciudades";

    protected $fillable = ['provincia_id', 'nombre'];

    /**
     * Get the provincia that owns the Ciudad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
}
