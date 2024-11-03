<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class ProtectedArea extends Model
{
    use HasFactory;

    // Definir los campos que pueden ser asignados en masa
    protected $fillable = ['area_name', 'area_km2', 'established_date', 'protection_level', 'region_id'];

    /**
    * Relación de muchos a muchos con el modelo Specie.
    * Un área protegida puede tener muchas especies, y una especie puede estar en muchas áreas protegidas.
    */
    public function species(): BelongsToMany
    {
        return $this->belongsToMany(Specie::class);
    }

    /**
     * Relación de muchos a uno con el modelo Region.
     * Un área protegida pertenece a una región.
    */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
