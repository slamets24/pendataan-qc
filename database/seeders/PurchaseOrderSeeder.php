<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        $purchaseOrders = [
            ['po_number' => 'PO/AZZ/2025/001', 'brand_id' => 1, 'article_id' => 1, 'po_date' => '2025-01-15', 'qty' => 100],
            ['po_number' => 'PO/AZZ/2025/002', 'brand_id' => 1, 'article_id' => 4, 'po_date' => '2025-02-01', 'qty' => 150],
            ['po_number' => 'PO/AZZ/2025/003', 'brand_id' => 1, 'article_id' => 7, 'po_date' => '2025-02-10', 'qty' => 200],
            ['po_number' => 'PO/MAK/2025/001', 'brand_id' => 4, 'article_id' => 2, 'po_date' => '2025-01-20', 'qty' => 80],
            ['po_number' => 'PO/AZZ-P/2025/001', 'brand_id' => 6, 'article_id' => 3, 'po_date' => '2025-02-05', 'qty' => 120],
            ['po_number' => 'PO/MAK/2025/002', 'brand_id' => 5, 'article_id' => 5, 'po_date' => '2025-02-12', 'qty' => 90],
            ['po_number' => 'PO/AZZ/2025/004', 'brand_id' => 1, 'article_id' => 8, 'po_date' => '2025-03-01', 'qty' => 180],
            ['po_number' => 'PO/MAK/2025/003', 'brand_id' => 7, 'article_id' => 6, 'po_date' => '2025-02-20', 'qty' => 100],
            ['po_number' => 'PO/AZZ-K/2025/001', 'brand_id' => 9, 'article_id' => 10, 'po_date' => '2025-03-05', 'qty' => 150],
            ['po_number' => 'PO/MAK/2025/004', 'brand_id' => 10, 'article_id' => 9, 'po_date' => '2025-03-10', 'qty' => 110],
        ];

        foreach ($purchaseOrders as $po) {
            PurchaseOrder::create($po);
        }
    }
}
