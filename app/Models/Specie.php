<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specie extends Model
{
    /** @use HasFactory<\Database\Factories\SpeciesFactory> */
    use HasFactory;

    // Definir los campos que pueden ser asignados en masa
    protected $fillable = [
        'scientific_name',
        'common_name',
        'description',
        'conservation_status',
        'average_lifespan',
        'diet_type',
        'population_estimate',
        'threats',
        'image'
    ];

    /**
    * Relación de muchos a muchos con el modelo ProtectedArea.
    * Una especie puede estar en muchas áreas protegidas, y un área protegida puede tener muchas especies.
    */
    public function protectedArea(): BelongsToMany
    {
        return $this->belongsToMany(ProtectedArea::class);
    }
}
