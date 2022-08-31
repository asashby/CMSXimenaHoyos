<?php

namespace Database\Seeders;

use App\Article;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory(1)->create([
            'title' => 'Sobre Ximena',
            'slug' => 'sobre-ximena',
        ]);
        Article::factory(10)->create();
    }
}
