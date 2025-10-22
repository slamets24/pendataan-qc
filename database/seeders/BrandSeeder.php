<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Azzahra', 'type' => 'po', 'description' => 'Brand utama dengan sistem PO'],
            ['name' => 'Lobang Kancing - Reseller', 'type' => 'reseller', 'description' => 'Channel reseller Lobang Kancing'],
            ['name' => 'Lobang Kancing - Store Stock', 'type' => 'store_stock', 'description' => 'Stock toko Lobang Kancing'],
            ['name' => 'Makloon A', 'type' => 'makloon', 'description' => 'Makloon partner A'],
            ['name' => 'Makloon B', 'type' => 'makloon', 'description' => 'Makloon partner B'],
            ['name' => 'Azzahra Premium', 'type' => 'po', 'description' => 'Line premium Azzahra'],
            ['name' => 'Makloon C', 'type' => 'makloon', 'description' => 'Makloon partner C'],
            ['name' => 'Lobang Kancing - Online', 'type' => 'store_stock', 'description' => 'Stock khusus online Lobang Kancing'],
            ['name' => 'Azzahra Kids', 'type' => 'po', 'description' => 'Line anak-anak Azzahra'],
            ['name' => 'Makloon D', 'type' => 'makloon', 'description' => 'Makloon partner D'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
