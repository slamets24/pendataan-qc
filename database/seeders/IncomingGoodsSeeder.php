<?php

namespace Database\Seeders;

use App\Models\IncomingGoods;
use Illuminate\Database\Seeder;

class IncomingGoodsSeeder extends Seeder
{
    public function run(): void
    {
        $incomingGoods = [
            ['brand_id' => 1, 'article_id' => 1, 'color_id' => 1, 'size_id' => 3, 'qty' => 50, 'date' => '2025-10-01', 'status' => 'received', 'created_by' => 1, 'po_id' => 1, 'sales_channel_id' => null, 'notes' => 'PO Azzahra batch 1'],
            ['brand_id' => 2, 'article_id' => 2, 'color_id' => 2, 'size_id' => 9, 'qty' => 100, 'date' => '2025-10-02', 'status' => 'qc', 'created_by' => 1, 'po_id' => null, 'sales_channel_id' => 1, 'notes' => 'Reseller Jakarta'],
            ['brand_id' => 3, 'article_id' => 3, 'color_id' => 3, 'size_id' => 9, 'qty' => 75, 'date' => '2025-10-03', 'status' => 'completed', 'created_by' => 1, 'po_id' => null, 'sales_channel_id' => 4, 'notes' => 'Store Tanah Abang'],
            ['brand_id' => 1, 'article_id' => 4, 'color_id' => 4, 'size_id' => 4, 'qty' => 60, 'date' => '2025-10-04', 'status' => 'received', 'created_by' => 1, 'po_id' => 2, 'sales_channel_id' => null, 'notes' => 'PO in progress'],
            ['brand_id' => 4, 'article_id' => 5, 'color_id' => 5, 'size_id' => 3, 'qty' => 45, 'date' => '2025-10-05', 'status' => 'revised', 'created_by' => 1, 'po_id' => 4, 'sales_channel_id' => null, 'notes' => 'Makloon perlu revisi'],
            ['brand_id' => 2, 'article_id' => 6, 'color_id' => 6, 'size_id' => 9, 'qty' => 80, 'date' => '2025-10-06', 'status' => 'qc', 'created_by' => 1, 'po_id' => null, 'sales_channel_id' => 2, 'notes' => 'Reseller Bandung'],
            ['brand_id' => 6, 'article_id' => 7, 'color_id' => 7, 'size_id' => 9, 'qty' => 90, 'date' => '2025-10-07', 'status' => 'completed', 'created_by' => 1, 'po_id' => 5, 'sales_channel_id' => null, 'notes' => 'Azzahra Premium'],
            ['brand_id' => 5, 'article_id' => 8, 'color_id' => 1, 'size_id' => 5, 'qty' => 55, 'date' => '2025-10-08', 'status' => 'received', 'created_by' => 1, 'po_id' => 6, 'sales_channel_id' => null, 'notes' => 'Makloon B'],
            ['brand_id' => 8, 'article_id' => 9, 'color_id' => 8, 'size_id' => 9, 'qty' => 70, 'date' => '2025-10-09', 'status' => 'qc', 'created_by' => 1, 'po_id' => null, 'sales_channel_id' => 6, 'notes' => 'Shopee order'],
            ['brand_id' => 3, 'article_id' => 10, 'color_id' => 9, 'size_id' => 9, 'qty' => 65, 'date' => '2025-10-10', 'status' => 'completed', 'created_by' => 1, 'po_id' => null, 'sales_channel_id' => 5, 'notes' => 'Store Mangga Dua'],
        ];

        foreach ($incomingGoods as $item) {
            IncomingGoods::create($item);
        }
    }
}
