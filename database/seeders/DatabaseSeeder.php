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
            ArticleSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            IncomingGoodsSeeder::class,
            QCSummarySeeder::class,
            RevisionSeeder::class,
        ]);
    }
}
