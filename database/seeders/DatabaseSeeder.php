<?php

namespace Database\Seeders;

use App\Models\Specie;
use App\Models\ProtectedArea;
use App\Models\Region;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 20 regiones
        Region::factory(25)->create();
        // Crear 25 áreas protegidas
        ProtectedArea::factory(20)->create();
        // Crear 15 especies
        Specie::factory(15)->create();

        
        // Poblar la tabla pivote protected_area_specie con asociaciones aleatorias
        ProtectedArea::all()->each(function ($protectedArea) {
            // Selecciona entre 1 y 5 especies aleatorias para cada área protegida
            $speciesIds = Specie::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $protectedArea->species()->attach($speciesIds);
        });
    }
}
