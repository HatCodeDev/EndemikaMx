<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Regions>
 */
class ProtectedAreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $protectionLevels = ['Alto', 'Medio', 'Bajo'];
        return [
            'area_name' => $this->faker->randomElement([
                'Reserva de la Biosfera Montes Azules',
                'Parque Nacional Cañón del Sumidero',
                'Reserva de la Biosfera El Vizcaíno',
                'Parque Nacional Cabo Pulmo',
                'Reserva de la Biosfera Calakmul',
                'Parque Nacional Isla Contoy'
            ]),
            'area_km2' => $this->faker->randomFloat(2, 10, 10000), // Rango de 10 a 10,000 km²
            'established_date' => $this->faker->dateTimeBetween('-100 years', 'now')->format('Y-m-d'),
            'protection_level' => $this->faker->randomElement($protectionLevels),
            'region_id' => $this->faker->numberBetween(1,25)
        ];
    }
}
