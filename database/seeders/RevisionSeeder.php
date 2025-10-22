<?php

namespace Database\Seeders;

use App\Models\Revision;
use Illuminate\Database\Seeder;

class RevisionSeeder extends Seeder
{
    public function run(): void
    {
        $revisions = [
            ['brand_id' => 1, 'article_id' => 1, 'color_id' => 1, 'size_id' => 3, 'date' => '2025-10-12', 'tailor_code' => 'TLR001', 'qc_code' => 'QC001', 'qty' => 2, 'reason' => 'Benang lepas Azzahra'],
            ['brand_id' => 2, 'article_id' => 2, 'color_id' => 2, 'size_id' => 9, 'date' => '2025-10-13', 'tailor_code' => 'TLR002', 'qc_code' => 'QC002', 'qty' => 1, 'reason' => 'Kancing tidak sejajar reseller'],
            ['brand_id' => 3, 'article_id' => 3, 'color_id' => 3, 'size_id' => 9, 'date' => '2025-10-13', 'tailor_code' => 'TLR003', 'qc_code' => 'QC001', 'qty' => 3, 'reason' => 'Jahitan tepi store'],
            ['brand_id' => 4, 'article_id' => 5, 'color_id' => 5, 'size_id' => 3, 'date' => '2025-10-14', 'tailor_code' => 'TLR001', 'qc_code' => 'QC003', 'qty' => 1, 'reason' => 'Noda makloon'],
            ['brand_id' => 1, 'article_id' => 4, 'color_id' => 4, 'size_id' => 4, 'date' => '2025-10-14', 'tailor_code' => 'TLR004', 'qc_code' => 'QC002', 'qty' => 2, 'reason' => 'Ukuran tidak standar'],
            ['brand_id' => 2, 'article_id' => 6, 'color_id' => 6, 'size_id' => 9, 'date' => '2025-10-15', 'tailor_code' => 'TLR002', 'qc_code' => 'QC001', 'qty' => 1, 'reason' => 'Serat kain keluar'],
            ['brand_id' => 6, 'article_id' => 7, 'color_id' => 7, 'size_id' => 5, 'date' => '2025-10-16', 'tailor_code' => 'TLR005', 'qc_code' => 'QC003', 'qty' => 2, 'reason' => 'Premium line revisi'],
            ['brand_id' => 5, 'article_id' => 8, 'color_id' => 1, 'size_id' => 9, 'date' => '2025-10-16', 'tailor_code' => 'TLR003', 'qc_code' => 'QC002', 'qty' => 1, 'reason' => 'Warna tidak merata makloon'],
            ['brand_id' => 8, 'article_id' => 9, 'color_id' => 8, 'size_id' => 3, 'date' => '2025-10-17', 'tailor_code' => 'TLR001', 'qc_code' => 'QC001', 'qty' => 1, 'reason' => 'Label terbalik online'],
            ['brand_id' => 3, 'article_id' => 10, 'color_id' => 9, 'size_id' => 9, 'date' => '2025-10-17', 'tailor_code' => 'TLR004', 'qc_code' => 'QC003', 'qty' => 2, 'reason' => 'Finishing kurang rapi'],
        ];

        foreach ($revisions as $revision) {
            Revision::create($revision);
        }
    }
}
