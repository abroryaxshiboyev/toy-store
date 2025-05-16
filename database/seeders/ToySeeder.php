<?php

namespace Database\Seeders;

use App\Models\Toy;
use Illuminate\Database\Seeder;

class ToySeeder extends Seeder
{
    public function run(): void
    {
        $toys = [
            [
                'name' => 'Robot Transformer',
                'description' => 'Qiziqarli transformer robot o\'yinchoq, 3 yoshdan katta bolalar uchun.',
                'price' => 29.99,
                'image' => 'toys/robot_transformer.jpg',
            ],
            [
                'name' => 'Yumshoq Ayig\'cha',
                'description' => 'Yumshoq va xavfsiz ayiq o\'yinchoq, barcha yoshdagilar uchun.',
                'price' => 15.50,
                'image' => 'toys/teddy_bear.jpg',
            ],
            [
                'name' => 'Lego Shahar',
                'description' => 'Lego konstruktor to\'plami, shahar qurish uchun.',
                'price' => 49.99,
                'image' => 'toys/lego_city.jpg',
            ],
            [
                'name' => 'Mashina Yarigi',
                'description' => 'Tezkor pultli mashina, ochiq havoda o\'ynash uchun.',
                'price' => 39.75,
                'image' => 'toys/race_car.jpg',
            ],
            [
                'name' => 'Musiqiy Pianino',
                'description' => 'Bolalar uchun rangli musiqiy pianino o\'yinchoq.',
                'price' => 22.00,
                'image' => 'toys/musical_piano.jpg',
            ],
        ];

        foreach ($toys as $toy) {
            Toy::create($toy);
        }
    }
}