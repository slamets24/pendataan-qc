<?php

namespace Database\Seeders;

use App\Models\OutgoingGoods;
use Illuminate\Database\Seeder;

class OutgoingGoodsSeeder extends Seeder
{
    public function run(): void
    {
        $outgoingGoods = [
            ['brand_id' => 1, 'article_id' => 1, 'color_id' => 1, 'size_id' => 3, 'incoming_id' => 1, 'qty' => 48, 'date' => '2025-10-11', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Azzahra batch 1 kirim ke packing'],
            ['brand_id' => 2, 'article_id' => 2, 'color_id' => 2, 'size_id' => 9, 'incoming_id' => 2, 'qty' => 95, 'date' => '2025-10-12', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Reseller Jakarta ready packing'],
            ['brand_id' => 3, 'article_id' => 3, 'color_id' => 3, 'size_id' => 9, 'incoming_id' => 3, 'qty' => 75, 'date' => '2025-10-13', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Store Tanah Abang complete'],
            ['brand_id' => 1, 'article_id' => 4, 'color_id' => 4, 'size_id' => 4, 'incoming_id' => 4, 'qty' => 5, 'date' => '2025-10-14', 'status' => 'returned_to_qc', 'created_by' => 1, 'notes' => 'Return untuk QC ulang'],
            ['brand_id' => 4, 'article_id' => 5, 'color_id' => 5, 'size_id' => 3, 'incoming_id' => 5, 'qty' => 40, 'date' => '2025-10-15', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Makloon A selesai QC'],
            ['brand_id' => 2, 'article_id' => 6, 'color_id' => 6, 'size_id' => 9, 'incoming_id' => 6, 'qty' => 78, 'date' => '2025-10-16', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Reseller Bandung siap kirim'],
            ['brand_id' => 6, 'article_id' => 7, 'color_id' => 7, 'size_id' => 9, 'incoming_id' => 7, 'qty' => 90, 'date' => '2025-10-17', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Premium line packing'],
            ['brand_id' => 5, 'article_id' => 8, 'color_id' => 1, 'size_id' => 5, 'incoming_id' => 8, 'qty' => 3, 'date' => '2025-10-18', 'status' => 'cancelled', 'created_by' => 1, 'notes' => 'Dibatalkan karena defect'],
            ['brand_id' => 8, 'article_id' => 9, 'color_id' => 8, 'size_id' => 9, 'incoming_id' => 9, 'qty' => 68, 'date' => '2025-10-19', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Shopee order packing'],
            ['brand_id' => 3, 'article_id' => 10, 'color_id' => 9, 'size_id' => 9, 'incoming_id' => 10, 'qty' => 65, 'date' => '2025-10-20', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Mangga Dua ready'],
        ];

        foreach ($outgoingGoods as $item) {
            OutgoingGoods::create($item);
        }
    }
}
