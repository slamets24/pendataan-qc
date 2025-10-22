<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            ['article_name' => 'Gamis Syari Premium', 'category' => 'Dress', 'created_date' => '2025-01-15'],
            ['article_name' => 'Bergo Instan Jersey', 'category' => 'Bergo', 'created_date' => '2025-01-20'],
            ['article_name' => 'Scarf Premium Cotton', 'category' => 'Scarf', 'created_date' => '2025-02-01'],
            ['article_name' => 'Dress Casual Modern', 'category' => 'Dress', 'created_date' => '2025-02-10'],
            ['article_name' => 'Pashmina Diamond', 'category' => 'Scarf', 'created_date' => '2025-02-15'],
            ['article_name' => 'Bergo Maryam Diamond', 'category' => 'Bergo', 'created_date' => '2025-03-01'],
            ['article_name' => 'Kaftan Maxi Dress', 'category' => 'Dress', 'created_date' => '2025-03-10'],
            ['article_name' => 'Hijab Segiempat Premium', 'category' => 'Scarf', 'created_date' => '2025-03-15'],
            ['article_name' => 'Bergo Plisket Ceruti', 'category' => 'Bergo', 'created_date' => '2025-04-01'],
            ['article_name' => 'Tunik Pocket Casual', 'category' => 'Dress', 'created_date' => '2025-04-05'],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
