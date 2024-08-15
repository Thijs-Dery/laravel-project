<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        News::create([
            'title' => 'Sample News Title',
            'content' => 'Sample news content.',
            'cover_image' => null,
            'published_at' => now(),
            'user_id' => 1, // Assuming user with ID 1 exists
        ]);
    }
}
