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

        // Poblar la tabla pivot protectedArea_specie
        Specie::all()->each(function ($species) {
            $protectedAreaIds = ProtectedArea::pluck('id');
            $species->protectedArea()->attach($protectedAreaIds);
        });
    }
}
