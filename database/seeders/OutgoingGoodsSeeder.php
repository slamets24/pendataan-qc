<?php

namespace Database\Seeders;

use App\Models\OutgoingGoods;
use Illuminate\Database\Seeder;

class OutgoingGoodsSeeder extends Seeder
{
    public function run(): void
    {
        $outgoingGoods = [
            // Link to PO #1 (PO/AZZ/250115-001) - Brand 1, Article 1, Color 1, Size 1, Qty 100
            ['po_id' => 1, 'brand_id' => 1, 'article_id' => 1, 'color_id' => 1, 'size_id' => 1, 'incoming_id' => 1, 'qty' => 50, 'date' => '2025-01-20', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Pengiriman batch 1 untuk PO/AZZ/250115-001'],
            ['po_id' => 1, 'brand_id' => 1, 'article_id' => 1, 'color_id' => 1, 'size_id' => 1, 'incoming_id' => null, 'qty' => 30, 'date' => '2025-01-25', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Pengiriman batch 2 untuk PO/AZZ/250115-001 (80/100 terkirim)'],

            // Link to PO #2 (PO/AZZ/250201-001) - Brand 1, Article 4, Color 2, Size 2, Qty 150
            ['po_id' => 2, 'brand_id' => 1, 'article_id' => 4, 'color_id' => 2, 'size_id' => 2, 'incoming_id' => 2, 'qty' => 75, 'date' => '2025-02-05', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Pengiriman batch 1 untuk PO/AZZ/250201-001 (75/150 terkirim)'],

            // Link to PO #4 (MK/MAK/250120-001) - Brand 4, Article 2, Color 4, Size 9, Qty 80
            ['po_id' => 4, 'brand_id' => 4, 'article_id' => 2, 'color_id' => 4, 'size_id' => 9, 'incoming_id' => 5, 'qty' => 80, 'date' => '2025-01-28', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'PO Makloon selesai 100% (80/80 terkirim)'],

            // Tidak terkait PO - pengiriman reguler
            ['po_id' => null, 'brand_id' => 2, 'article_id' => 3, 'color_id' => 3, 'size_id' => 9, 'incoming_id' => 3, 'qty' => 75, 'date' => '2025-02-10', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Store stock Tanah Abang (tidak terkait PO)'],
            ['po_id' => null, 'brand_id' => 2, 'article_id' => 6, 'color_id' => 6, 'size_id' => 9, 'incoming_id' => 6, 'qty' => 78, 'date' => '2025-02-15', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Reseller Bandung (tidak terkait PO)'],

            // Return to QC
            ['po_id' => null, 'brand_id' => 1, 'article_id' => 4, 'color_id' => 4, 'size_id' => 4, 'incoming_id' => 4, 'qty' => 5, 'date' => '2025-02-18', 'status' => 'returned_to_qc', 'created_by' => 1, 'notes' => 'Return untuk QC ulang - ada defect'],

            // Cancelled
            ['po_id' => null, 'brand_id' => 5, 'article_id' => 8, 'color_id' => 1, 'size_id' => 5, 'incoming_id' => 8, 'qty' => 3, 'date' => '2025-02-20', 'status' => 'cancelled', 'created_by' => 1, 'notes' => 'Dibatalkan karena defect berat'],

            // Link to PO #7 (PO/AZZ/250301-001) - Brand 1, Article 8, Color 2, Size 2, Qty 180
            ['po_id' => 7, 'brand_id' => 1, 'article_id' => 8, 'color_id' => 2, 'size_id' => 2, 'incoming_id' => null, 'qty' => 100, 'date' => '2025-03-05', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Pengiriman batch 1 untuk PO/AZZ/250301-001 (100/180 terkirim)'],

            // Tidak terkait PO
            ['po_id' => null, 'brand_id' => 1, 'article_id' => 10, 'color_id' => 9, 'size_id' => 9, 'incoming_id' => 10, 'qty' => 65, 'date' => '2025-03-10', 'status' => 'sent_to_packing', 'created_by' => 1, 'notes' => 'Store stock Mangga Dua (tidak terkait PO)'],
        ];

        foreach ($outgoingGoods as $item) {
            OutgoingGoods::create($item);
        }
    }
}
