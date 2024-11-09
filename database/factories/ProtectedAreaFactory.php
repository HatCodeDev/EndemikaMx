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
            'area_name' => $this->faker->unique()->randomElement([
                'Reserva de la Biosfera Montes Azules',
                'Parque Nacional Cañón del Sumidero',
                'Reserva de la Biosfera El Vizcaíno',
                'Parque Nacional Cabo Pulmo',
                'Reserva de la Biosfera Calakmul',
                'Parque Nacional Isla Contoy',
                'Reserva de la Biosfera Sierra Gorda',
                'Parque Nacional Lagunas de Zempoala',
                'Reserva de la Biosfera Ría Celestún',
                'Parque Nacional Nevado de Toluca',
                'Reserva de la Biosfera Sian Ka’an',
                'Parque Nacional Bahía de Loreto',
                'Reserva de la Biosfera Mariposa Monarca',
                'Parque Nacional Cofre de Perote',
                'Reserva de la Biosfera La Encrucijada',
                'Parque Nacional Huatulco',
                'Reserva de la Biosfera Chamela-Cuixmala',
                'Parque Nacional Izta-Popo Zoquiapan',
                'Reserva de la Biosfera Pantanos de Centla',
                'Parque Nacional Pico de Orizaba',
                'Reserva de la Biosfera Selva El Ocote',
                'Parque Nacional Desierto de los Leones',
                'Reserva de la Biosfera La Michilía',
                'Parque Nacional Barranca del Cupatitzio',
                'Reserva de la Biosfera Mapimí'
            ]),
            'area_km2' => $this->faker->randomFloat(2, 10, 10000), // Rango de 10 a 10,000 km²
            'established_date' => $this->faker->dateTimeBetween('-100 years', 'now')->format('Y-m-d'),
            'protection_level' => $this->faker->randomElement($protectionLevels),
            'region_id' => $this->faker->numberBetween(1,25)
        ];
    }
}
