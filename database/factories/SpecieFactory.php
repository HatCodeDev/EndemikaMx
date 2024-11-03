<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Species>
 */
class SpecieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conservationStatuses = [
            'En peligro crítico',
            'En peligro',
            'Vulnerable',
            'Casi amenazado',
            'Preocupación menor'
        ];

        $dietTypes = ['Herbívoro', 'Carnívoro', 'Omnívoro', 'Otro'];

        $speciesData = [
            [
                'scientific_name' => 'Ambystoma mexicanum',
                'common_name' => 'Ajolote',
                'description' => 'Es una especie de salamandra que se encuentra en el complejo sistema de canales y lagos de Xochimilco, en Ciudad de México. Es conocida por su capacidad de regenerar extremidades y otros órganos.',
                'threats' => 'Pérdida de hábitat, contaminación del agua, especies invasoras.'
            ],
            [
                'scientific_name' => 'Panthera onca',
                'common_name' => 'Jaguar',
                'description' => 'Es el felino más grande de América y habita en las selvas tropicales de México. Es conocido por su habilidad para nadar y su fuerza excepcional.',
                'threats' => 'Pérdida de hábitat, caza furtiva, conflictos con humanos.'
            ],
            [
                'scientific_name' => 'Cyanocorax sanblasianus',
                'common_name' => 'Chara de San Blas',
                'description' => 'Es un ave endémica de México que habita en los bosques secos de la costa del Pacífico. Se caracteriza por su plumaje azul intenso y su inteligencia.',
                'threats' => 'Pérdida de hábitat y fragmentación de los bosques secos.'
            ],
            [
                'scientific_name' => 'Bassariscus sumichrasti',
                'common_name' => 'Cacomixtle tropical',
                'description' => 'Un mamífero parecido al mapache, endémico de México y Centroamérica, que habita en zonas boscosas y selvas.',
                'threats' => 'Deforestación y caza furtiva.'
            ],
            [
                'scientific_name' => 'Pavo ocellatus',
                'common_name' => 'Pavo Ocelado',
                'description' => 'Es un pavo silvestre con colores llamativos, que habita en las selvas de la Península de Yucatán. Es conocido por su plumaje iridiscente y su canto distintivo.',
                'threats' => 'Pérdida de hábitat y caza excesiva.'
            ]
        ];

        // Selecciona una especie aleatoria de la lista
        $species = $this->faker->randomElement($speciesData);

        return [
            'scientific_name' => $species['scientific_name'],
            'common_name' => $species['common_name'],
            'description' => $species['description'],
            'conservation_status' => $this->faker->randomElement($conservationStatuses),
            'average_lifespan' => $this->faker->numberBetween(5, 30), 
            'diet_type' => $this->faker->randomElement($dietTypes),
            'population_estimate' => $this->faker->numberBetween(100, 5000), 
            'threats' => $species['threats'],
            'image' => '/img/example.png',
        ];
    }
}
