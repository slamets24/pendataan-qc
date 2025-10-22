<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        $purchaseOrders = [
            ['po_number' => 'PO/AZZ/2025/001', 'brand_id' => 1, 'article_id' => 1, 'color_id' => 1, 'size_id' => 1, 'order_date' => '2025-01-15', 'qty_ordered' => 100, 'status' => 'open', 'notes' => null],
            ['po_number' => 'PO/AZZ/2025/002', 'brand_id' => 1, 'article_id' => 4, 'color_id' => 2, 'size_id' => 2, 'order_date' => '2025-02-01', 'qty_ordered' => 150, 'status' => 'in_progress', 'notes' => null],
            ['po_number' => 'PO/AZZ/2025/003', 'brand_id' => 1, 'article_id' => 7, 'color_id' => 3, 'size_id' => 3, 'order_date' => '2025-02-10', 'qty_ordered' => 200, 'status' => 'completed', 'notes' => null],
            ['po_number' => 'PO/MAK/2025/001', 'brand_id' => 4, 'article_id' => 2, 'color_id' => 4, 'size_id' => 4, 'order_date' => '2025-01-20', 'qty_ordered' => 80, 'status' => 'open', 'notes' => null],
            ['po_number' => 'PO/AZZ-P/2025/001', 'brand_id' => 6, 'article_id' => 3, 'color_id' => 5, 'size_id' => 5, 'order_date' => '2025-02-05', 'qty_ordered' => 120, 'status' => 'in_progress', 'notes' => null],
            ['po_number' => 'PO/MAK/2025/002', 'brand_id' => 5, 'article_id' => 5, 'color_id' => 1, 'size_id' => 1, 'order_date' => '2025-02-12', 'qty_ordered' => 90, 'status' => 'completed', 'notes' => null],
            ['po_number' => 'PO/AZZ/2025/004', 'brand_id' => 1, 'article_id' => 8, 'color_id' => 2, 'size_id' => 2, 'order_date' => '2025-03-01', 'qty_ordered' => 180, 'status' => 'open', 'notes' => null],
            ['po_number' => 'PO/MAK/2025/003', 'brand_id' => 7, 'article_id' => 6, 'color_id' => 3, 'size_id' => 3, 'order_date' => '2025-02-20', 'qty_ordered' => 100, 'status' => 'in_progress', 'notes' => null],
            ['po_number' => 'PO/AZZ-K/2025/001', 'brand_id' => 9, 'article_id' => 10, 'color_id' => 4, 'size_id' => 4, 'order_date' => '2025-03-05', 'qty_ordered' => 150, 'status' => 'completed', 'notes' => null],
            ['po_number' => 'PO/MAK/2025/004', 'brand_id' => 10, 'article_id' => 9, 'color_id' => 5, 'size_id' => 5, 'order_date' => '2025-03-10', 'qty_ordered' => 110, 'status' => 'open', 'notes' => null],
        ];

        foreach ($purchaseOrders as $po) {
            PurchaseOrder::create($po);
        }
    }
}
