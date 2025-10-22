<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            ['code' => 'XS'],
            ['code' => 'S'],
            ['code' => 'M'],
            ['code' => 'L'],
            ['code' => 'XL'],
            ['code' => 'XXL'],
            ['code' => 'XXXL'],
            ['code' => 'Jumbo'],
            ['code' => 'All Size'],
            ['code' => 'Free Size'],
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }
    }
}
