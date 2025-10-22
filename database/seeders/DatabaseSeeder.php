<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed in order due to foreign key constraints
        $this->call([
            UserSeeder::class,
            BrandSeeder::class,            // Must be before everything else
            ArticleSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            SalesChannelSeeder::class,     // After Brand
            PurchaseOrderSeeder::class,    // After Brand & Article
            IncomingGoodsSeeder::class,    // After all master data
            QCSummarySeeder::class,
            RevisionSeeder::class,
            OutgoingGoodsSeeder::class,    // After IncomingGoods
        ]);
    }
}
