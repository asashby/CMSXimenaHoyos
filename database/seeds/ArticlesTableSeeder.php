<?php

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
        factory(Article::class, 1)->create([
            'title' => 'Sobre Ximena',
            'slug' => 'sobre-ximena',
        ]);
        factory(Article::class, 10)->create();
    }
}
