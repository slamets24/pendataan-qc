<?php

namespace Database\Seeders;

use App\Models\QCSummary;
use Illuminate\Database\Seeder;

class QCSummarySeeder extends Seeder
{
    public function run(): void
    {
        $qcSummaries = [
            ['brand_id' => 1, 'article_id' => 1, 'date' => '2025-10-15', 'process' => 'hanging', 'qty' => 50, 'notes' => 'Azzahra hanging batch 1'],
            ['brand_id' => 2, 'article_id' => 2, 'date' => '2025-10-15', 'process' => 'buttoning', 'qty' => 100, 'notes' => 'Lobang Kancing reseller'],
            ['brand_id' => 3, 'article_id' => 3, 'date' => '2025-10-16', 'process' => 'plating', 'qty' => 75, 'notes' => 'Store stock plating'],
            ['brand_id' => 1, 'article_id' => 4, 'date' => '2025-10-16', 'process' => 'steaming', 'qty' => 60, 'notes' => 'Azzahra steaming'],
            ['brand_id' => 4, 'article_id' => 5, 'date' => '2025-10-17', 'process' => 'thread_trimming', 'qty' => 45, 'notes' => 'Makloon A finishing'],
            ['brand_id' => 2, 'article_id' => 6, 'date' => '2025-10-17', 'process' => 'hanging', 'qty' => 80, 'notes' => 'Reseller batch 2'],
            ['brand_id' => 6, 'article_id' => 7, 'date' => '2025-10-18', 'process' => 'plating', 'qty' => 90, 'notes' => 'Premium line plating'],
            ['brand_id' => 5, 'article_id' => 8, 'date' => '2025-10-18', 'process' => 'steaming', 'qty' => 55, 'notes' => 'Makloon B steaming'],
            ['brand_id' => 8, 'article_id' => 9, 'date' => '2025-10-19', 'process' => 'thread_trimming', 'qty' => 70, 'notes' => 'Online channel QC'],
            ['brand_id' => 3, 'article_id' => 10, 'date' => '2025-10-19', 'process' => 'buttoning', 'qty' => 65, 'notes' => 'Store final check'],
        ];

        foreach ($qcSummaries as $summary) {
            QCSummary::create($summary);
        }
    }
}
