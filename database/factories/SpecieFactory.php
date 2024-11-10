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

        $dietTypes = [
            'Semillas',
            'Bambú',
            'Frutas',
            'Insectos',
            'Hierbas',
            'Carne de pequeños mamíferos',
            'Pescado',
            'Plantas acuáticas',
            'Raíces',
            'Nectar',
            'Hojas',
            'Otro'
        ];

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
            ],
            [
                'scientific_name' => 'Leopardus wiedii',
                'common_name' => 'Margay',
                'description' => 'Un felino pequeño de hábitos nocturnos, conocido por su habilidad para trepar árboles.',
                'threats' => 'Pérdida de hábitat y caza furtiva.'
            ],
            [
                'scientific_name' => 'Mustela frenata',
                'common_name' => 'Comadreja de cola larga',
                'description' => 'Un pequeño carnívoro ágil y rápido, que habita en bosques templados y zonas montañosas.',
                'threats' => 'Destrucción de hábitat y fragmentación.'
            ],
            [
                'scientific_name' => 'Ovis canadensis',
                'common_name' => 'Borrego cimarrón',
                'description' => 'Un mamífero conocido por sus cuernos grandes y su habilidad para trepar terrenos escarpados.',
                'threats' => 'Caza y pérdida de hábitat.'
            ],
            [
                'scientific_name' => 'Crotalus durissus',
                'common_name' => 'Serpiente de cascabel',
                'description' => 'Una especie de serpiente venenosa que habita en zonas áridas y semiáridas de México.',
                'threats' => 'Muerte intencionada por miedo y pérdida de hábitat.'
            ],
            [
                'scientific_name' => 'Urocyon cinereoargenteus',
                'common_name' => 'Zorro gris',
                'description' => 'Un mamífero carnívoro adaptable que habita en diversas regiones de México.',
                'threats' => 'Pérdida de hábitat y caza.'
            ],
            [
                'scientific_name' => 'Tapirus bairdii',
                'common_name' => 'Tapir Centroamericano',
                'description' => 'Es el mamífero terrestre más grande de América Central, habita en selvas y pantanos.',
                'threats' => 'Pérdida de hábitat y caza ilegal.'
            ],
            [
                'scientific_name' => 'Vulpes macrotis',
                'common_name' => 'Zorro del Desierto',
                'description' => 'Un zorro adaptado a la vida en zonas áridas, conocido por sus grandes orejas.',
                'threats' => 'Pérdida de hábitat debido a la expansión agrícola.'
            ],
            [
                'scientific_name' => 'Herpailurus yagouaroundi',
                'common_name' => 'Yaguarundí',
                'description' => 'Un felino pequeño y ágil, que habita en selvas y bosques densos.',
                'threats' => 'Destrucción de hábitat y caza.'
            ],
            [
                'scientific_name' => 'Crax rubra',
                'common_name' => 'Hocofaisán',
                'description' => 'Un ave grande de la familia Cracidae que habita en las selvas tropicales de México.',
                'threats' => 'Caza y destrucción de su hábitat.'
            ],
            [
                'scientific_name' => 'Chelonia mydas',
                'common_name' => 'Tortuga Verde',
                'description' => 'Una tortuga marina que habita en aguas tropicales y subtropicales.',
                'threats' => 'Captura accidental, pérdida de hábitat y contaminación del océano.'
            ]
        ];
        
        $species = $this->faker->unique()->randomElement($speciesData);

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
