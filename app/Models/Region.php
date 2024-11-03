<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    /** @use HasFactory<\Database\Factories\RegionsFactory> */
    use HasFactory;

    // Definir los campos que pueden ser asignados en masa
    protected $fillable = ['region_name', 'area_km2', 'main_landforms'];

    /**
     * Relación de uno a muchos con el modelo ProtectedArea.
     * Una región puede tener muchas áreas protegidas.
    */
    public function protectedArea(): HasMany
    {
        return $this->hasMany(ProtectedArea::class, 'Region_id');
    }

}
