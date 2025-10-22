<?php

namespace Database\Seeders;

use App\Models\Revision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $revisions = [
            ['article_id' => 1, 'color_id' => 1, 'size_id' => 3, 'date' => '2025-10-12', 'tailor_code' => 'TLR001', 'qc_code' => 'QC001', 'qty' => 2, 'reason' => 'Benang lepas di bagian lengan'],
            ['article_id' => 2, 'color_id' => 2, 'size_id' => 9, 'date' => '2025-10-13', 'tailor_code' => 'TLR002', 'qc_code' => 'QC002', 'qty' => 1, 'reason' => 'Kancing tidak sejajar'],
            ['article_id' => 3, 'color_id' => 3, 'size_id' => 9, 'date' => '2025-10-13', 'tailor_code' => 'TLR003', 'qc_code' => 'QC001', 'qty' => 3, 'reason' => 'Jahitan tepi tidak rapi'],
            ['article_id' => 4, 'color_id' => 5, 'size_id' => 3, 'date' => '2025-10-14', 'tailor_code' => 'TLR001', 'qc_code' => 'QC003', 'qty' => 1, 'reason' => 'Noda kecil pada kain'],
            ['article_id' => 1, 'color_id' => 4, 'size_id' => 4, 'date' => '2025-10-14', 'tailor_code' => 'TLR004', 'qc_code' => 'QC002', 'qty' => 2, 'reason' => 'Ukuran tidak sesuai standar'],
            ['article_id' => 5, 'color_id' => 6, 'size_id' => 9, 'date' => '2025-10-15', 'tailor_code' => 'TLR002', 'qc_code' => 'QC001', 'qty' => 1, 'reason' => 'Serat kain keluar'],
            ['article_id' => 7, 'color_id' => 1, 'size_id' => 5, 'date' => '2025-10-16', 'tailor_code' => 'TLR005', 'qc_code' => 'QC003', 'qty' => 2, 'reason' => 'Ritsleting macet'],
            ['article_id' => 8, 'color_id' => 8, 'size_id' => 9, 'date' => '2025-10-16', 'tailor_code' => 'TLR003', 'qc_code' => 'QC002', 'qty' => 1, 'reason' => 'Warna tidak merata'],
            ['article_id' => 4, 'color_id' => 5, 'size_id' => 3, 'date' => '2025-10-17', 'tailor_code' => 'TLR001', 'qc_code' => 'QC001', 'qty' => 1, 'reason' => 'Label terbalik'],
            ['article_id' => 9, 'color_id' => 9, 'size_id' => 9, 'date' => '2025-10-17', 'tailor_code' => 'TLR004', 'qc_code' => 'QC003', 'qty' => 2, 'reason' => 'Plisket kurang rapi'],
        ];

        foreach ($revisions as $revision) {
            Revision::create($revision);
        }
    }
}
