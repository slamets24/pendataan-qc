<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Hitam'],
            ['name' => 'Putih'],
            ['name' => 'Navy'],
            ['name' => 'Maroon'],
            ['name' => 'Dusty Pink'],
            ['name' => 'Abu-Abu'],
            ['name' => 'Mocca'],
            ['name' => 'Hijau Army'],
            ['name' => 'Cream'],
            ['name' => 'Biru Turquoise'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
