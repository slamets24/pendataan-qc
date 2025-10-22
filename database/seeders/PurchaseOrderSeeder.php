<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        $purchaseOrders = [
            ['po_number' => 'PO/AZZ/2025/001', 'brand_id' => 1, 'article_id' => 1, 'order_date' => '2025-01-15', 'qty_ordered' => 100, 'status' => 'completed', 'notes' => 'Batch pertama 2025'],
            ['po_number' => 'PO/AZZ/2025/002', 'brand_id' => 1, 'article_id' => 4, 'order_date' => '2025-02-01', 'qty_ordered' => 150, 'status' => 'in_progress', 'notes' => 'Proses produksi'],
            ['po_number' => 'PO/AZZ/2025/003', 'brand_id' => 1, 'article_id' => 7, 'order_date' => '2025-02-10', 'qty_ordered' => 200, 'status' => 'open', 'notes' => 'Menunggu produksi'],
            ['po_number' => 'PO/MAK/2025/001', 'brand_id' => 4, 'article_id' => 2, 'order_date' => '2025-01-20', 'qty_ordered' => 80, 'status' => 'completed', 'notes' => 'Makloon selesai'],
            ['po_number' => 'PO/AZZ-P/2025/001', 'brand_id' => 6, 'article_id' => 3, 'order_date' => '2025-02-05', 'qty_ordered' => 120, 'status' => 'in_progress', 'notes' => 'Line premium'],
            ['po_number' => 'PO/MAK/2025/002', 'brand_id' => 5, 'article_id' => 5, 'order_date' => '2025-02-12', 'qty_ordered' => 90, 'status' => 'completed', 'notes' => 'Partner B'],
            ['po_number' => 'PO/AZZ/2025/004', 'brand_id' => 1, 'article_id' => 8, 'order_date' => '2025-03-01', 'qty_ordered' => 180, 'status' => 'open', 'notes' => 'Order Maret'],
            ['po_number' => 'PO/MAK/2025/003', 'brand_id' => 7, 'article_id' => 6, 'order_date' => '2025-02-20', 'qty_ordered' => 100, 'status' => 'in_progress', 'notes' => 'Partner C proses'],
            ['po_number' => 'PO/AZZ-K/2025/001', 'brand_id' => 9, 'article_id' => 10, 'order_date' => '2025-03-05', 'qty_ordered' => 150, 'status' => 'open', 'notes' => 'Line kids'],
            ['po_number' => 'PO/MAK/2025/004', 'brand_id' => 10, 'article_id' => 9, 'order_date' => '2025-03-10', 'qty_ordered' => 110, 'status' => 'open', 'notes' => 'Partner D'],
        ];

        foreach ($purchaseOrders as $po) {
            PurchaseOrder::create($po);
        }
    }
}
