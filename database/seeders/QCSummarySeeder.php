<?php

namespace Database\Seeders;

use App\Models\QCSummary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QCSummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $qcSummaries = [
            ['article_id' => 1, 'date' => '2025-10-15', 'process' => 'hanging', 'qty' => 50, 'notes' => 'Hanging selesai untuk batch 1'],
            ['article_id' => 2, 'date' => '2025-10-15', 'process' => 'buttoning', 'qty' => 100, 'notes' => 'Proses buttoning bergo'],
            ['article_id' => 3, 'date' => '2025-10-16', 'process' => 'plating', 'qty' => 75, 'notes' => 'Plating scarf premium'],
            ['article_id' => 1, 'date' => '2025-10-16', 'process' => 'steaming', 'qty' => 50, 'notes' => 'Steaming gamis'],
            ['article_id' => 4, 'date' => '2025-10-17', 'process' => 'thread_trimming', 'qty' => 45, 'notes' => 'Potong benang dress casual'],
            ['article_id' => 5, 'date' => '2025-10-17', 'process' => 'hanging', 'qty' => 80, 'notes' => 'Hanging pashmina'],
            ['article_id' => 6, 'date' => '2025-10-18', 'process' => 'plating', 'qty' => 90, 'notes' => 'Plating bergo maryam'],
            ['article_id' => 7, 'date' => '2025-10-18', 'process' => 'steaming', 'qty' => 55, 'notes' => 'Steaming kaftan'],
            ['article_id' => 8, 'date' => '2025-10-19', 'process' => 'thread_trimming', 'qty' => 70, 'notes' => 'Final check hijab'],
            ['article_id' => 9, 'date' => '2025-10-19', 'process' => 'buttoning', 'qty' => 65, 'notes' => 'Buttoning bergo plisket'],
        ];

        foreach ($qcSummaries as $summary) {
            QCSummary::create($summary);
        }
    }
}
