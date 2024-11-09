<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Regions>
 */
class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $landforms = [
            'Montañas y bosques templados',
            'Desierto y matorrales',
            'Selva tropical',
            'Manglares y humedales',
            'Playas y costas',
            'Llanuras y pastizales'
        ];
        return [
            'region_name' => $this->faker->unique()->randomElement([
                'Sierra Madre Occidental',
                'Altiplano Potosino',
                'Selva Lacandona',
                'Costa de Jalisco',
                'Desierto de Sonora',
                'Península de Yucatán',
                'Eje Neovolcánico',
                'Sierra Madre Oriental',
                'Baja California Norte',
                'Baja California Sur',
                'Sierra Gorda',
                'Costa de Chiapas',
                'Valle de México',
                'Costa de Guerrero',
                'Desierto de Chihuahua',
                'Selva Baja Veracruzana',
                'Planicie Costera del Golfo',
                'Sierra Tarahumara',
                'Sierra de Huautla',
                'Costa de Oaxaca',
                'Costa de Sinaloa',
                'Cuenca del Río Bravo',
                'Islas del Mar de Cortés',
                'Laguna de Términos',
                'Llanuras de Tabasco'
            ]),
            'area_km2' => $this->faker->randomFloat(2, 50, 50000), 
            'main_landforms' => $this->faker->randomElement($landforms),
            
            

        ];
    }
}
