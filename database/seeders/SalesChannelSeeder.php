<?php

namespace Database\Seeders;

use App\Models\SalesChannel;
use Illuminate\Database\Seeder;

class SalesChannelSeeder extends Seeder
{
    public function run(): void
    {
        $salesChannels = [
            ['brand_id' => 2, 'name' => 'Reseller Jakarta', 'description' => 'Reseller area Jakarta'],
            ['brand_id' => 2, 'name' => 'Reseller Bandung', 'description' => 'Reseller area Bandung'],
            ['brand_id' => 2, 'name' => 'Reseller Surabaya', 'description' => 'Reseller area Surabaya'],
            ['brand_id' => 3, 'name' => 'Store Tanah Abang', 'description' => 'Toko di Tanah Abang'],
            ['brand_id' => 3, 'name' => 'Store Mangga Dua', 'description' => 'Toko di Mangga Dua'],
            ['brand_id' => 8, 'name' => 'Shopee', 'description' => 'Penjualan via Shopee'],
            ['brand_id' => 8, 'name' => 'Tokopedia', 'description' => 'Penjualan via Tokopedia'],
            ['brand_id' => 8, 'name' => 'TikTok Shop', 'description' => 'Penjualan via TikTok'],
            ['brand_id' => 2, 'name' => 'Reseller Semarang', 'description' => 'Reseller area Semarang'],
            ['brand_id' => 3, 'name' => 'Store Pasar Baru', 'description' => 'Toko di Pasar Baru'],
        ];

        foreach ($salesChannels as $channel) {
            SalesChannel::create($channel);
        }
    }
}
