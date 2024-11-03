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
            'region_name' => $this->faker->randomElement([
                'Sierra Madre Occidental',
                'Altiplano Potosino',
                'Selva Lacandona',
                'Costa de Jalisco',
                'Desierto de Sonora',
                'Península de Yucatán'
            ]),
            'area_km2' => $this->faker->randomFloat(2, 50, 50000), 
            'main_landforms' => $this->faker->randomElement($landforms),
            
            

        ];
    }
}
