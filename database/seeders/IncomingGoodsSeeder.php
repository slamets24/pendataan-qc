<?php

namespace Database\Seeders;

use App\Models\IncomingGoods;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomingGoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incomingGoods = [
            ['article_id' => 1, 'color_id' => 1, 'size_id' => 3, 'qty' => 50, 'date' => '2025-10-01', 'status' => 'received', 'created_by' => 1, 'notes' => 'Batch pertama Oktober'],
            ['article_id' => 2, 'color_id' => 2, 'size_id' => 9, 'qty' => 100, 'date' => '2025-10-02', 'status' => 'qc', 'created_by' => 1, 'notes' => 'Sedang dalam proses QC'],
            ['article_id' => 3, 'color_id' => 3, 'size_id' => 9, 'qty' => 75, 'date' => '2025-10-03', 'status' => 'completed', 'created_by' => 1, 'notes' => 'QC selesai, siap packing'],
            ['article_id' => 1, 'color_id' => 4, 'size_id' => 4, 'qty' => 60, 'date' => '2025-10-04', 'status' => 'received', 'created_by' => 1, 'notes' => 'Baru masuk gudang'],
            ['article_id' => 4, 'color_id' => 5, 'size_id' => 3, 'qty' => 45, 'date' => '2025-10-05', 'status' => 'revised', 'created_by' => 1, 'notes' => 'Perlu revisi benang'],
            ['article_id' => 5, 'color_id' => 6, 'size_id' => 9, 'qty' => 80, 'date' => '2025-10-06', 'status' => 'qc', 'created_by' => 1, 'notes' => 'Dalam proses hanging'],
            ['article_id' => 6, 'color_id' => 7, 'size_id' => 9, 'qty' => 90, 'date' => '2025-10-07', 'status' => 'completed', 'created_by' => 1, 'notes' => 'Bergo ready stock'],
            ['article_id' => 7, 'color_id' => 1, 'size_id' => 5, 'qty' => 55, 'date' => '2025-10-08', 'status' => 'received', 'created_by' => 1, 'notes' => 'Kaftan hitam'],
            ['article_id' => 8, 'color_id' => 8, 'size_id' => 9, 'qty' => 70, 'date' => '2025-10-09', 'status' => 'qc', 'created_by' => 1, 'notes' => 'Scarf premium check'],
            ['article_id' => 9, 'color_id' => 9, 'size_id' => 9, 'qty' => 65, 'date' => '2025-10-10', 'status' => 'completed', 'created_by' => 1, 'notes' => 'Bergo cream selesai'],
        ];

        foreach ($incomingGoods as $item) {
            IncomingGoods::create($item);
        }
    }
}
