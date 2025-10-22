<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        $purchaseOrders = [
            // Status akan auto-set ke 'in_progress' oleh migration default
            ['po_number' => 'PO/AZZ/250115-001', 'brand_id' => 1, 'article_id' => 1, 'color_id' => 1, 'size_id' => 1, 'order_date' => '2025-01-15', 'qty_ordered' => 100, 'notes' => 'PO Gamis Syari Premium warna Hitam'],
            ['po_number' => 'PO/AZZ/250201-001', 'brand_id' => 1, 'article_id' => 4, 'color_id' => 2, 'size_id' => 2, 'order_date' => '2025-02-01', 'qty_ordered' => 150, 'notes' => 'PO Khimar Instan'],
            ['po_number' => 'PO/AZZ/250210-001', 'brand_id' => 1, 'article_id' => 7, 'color_id' => 3, 'size_id' => 3, 'order_date' => '2025-02-10', 'qty_ordered' => 200, 'notes' => null],
            ['po_number' => 'MK/MAK/250120-001', 'brand_id' => 4, 'article_id' => 2, 'color_id' => 4, 'size_id' => 9, 'order_date' => '2025-01-20', 'qty_ordered' => 80, 'notes' => 'Makloon Bergo Instan'],
            ['po_number' => 'PO/AZZ/250205-001', 'brand_id' => 1, 'article_id' => 3, 'color_id' => 5, 'size_id' => 5, 'order_date' => '2025-02-05', 'qty_ordered' => 120, 'notes' => null],
            ['po_number' => 'MK/MAK/250212-001', 'brand_id' => 5, 'article_id' => 5, 'color_id' => 1, 'size_id' => 1, 'order_date' => '2025-02-12', 'qty_ordered' => 90, 'notes' => null],
            ['po_number' => 'PO/AZZ/250301-001', 'brand_id' => 1, 'article_id' => 8, 'color_id' => 2, 'size_id' => 2, 'order_date' => '2025-03-01', 'qty_ordered' => 180, 'notes' => null],
            ['po_number' => 'MK/MAK/250220-001', 'brand_id' => 4, 'article_id' => 6, 'color_id' => 3, 'size_id' => 3, 'order_date' => '2025-02-20', 'qty_ordered' => 100, 'notes' => null],
            ['po_number' => 'PO/AZZ/250305-001', 'brand_id' => 1, 'article_id' => 10, 'color_id' => 4, 'size_id' => 4, 'order_date' => '2025-03-05', 'qty_ordered' => 150, 'notes' => null],
            ['po_number' => 'MK/MAK/250310-001', 'brand_id' => 4, 'article_id' => 9, 'color_id' => 5, 'size_id' => 5, 'order_date' => '2025-03-10', 'qty_ordered' => 110, 'notes' => null],
        ];

        foreach ($purchaseOrders as $po) {
            PurchaseOrder::create($po);
        }
    }
}
