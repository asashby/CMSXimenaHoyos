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
        /*
        $fecha = new DateTime('now', new DateTimeZone('America/Lima'));
        DB::table('articles')->delete();
        $articlesRecords = [
            [
                'id' => 1,
                'title' => 'Se fue Merino',
                'subtitle' => 'Viva la Generacion del Bicentenario',
                'slug' => 'se-fue-merino',
                'route' => 'se-fue-merino',
                'admin_id' => 1,
                'content' => '',
                'section_id' => 1,
                'content' => '',
                'page_image' => 'admin@apprunn.com',
                'published_at' => $fecha,
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 2,
                'title' => 'Hoy es la entrega final de Enel',
                'subtitle' => 'Vamos a Morirrrr',
                'slug' => 'hoy-es-la-entrega-final-de-enel',
                'route' => 'vamos-a-morir',
                'admin_id' => 1,
                'content' => '',
                'section_id' => 1,
                'page_image' => 'admin@apprunn.com',
                'published_at' => $fecha,
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 3,
                'title' => 'Debo Modificar Notifications',
                'subtitle' => 'Sino Vamos a Morirrrr',
                'slug' => 'debo-modificar-notifications',
                'route' => 'debe-guardar-en-el-sheet',
                'admin_id' => 1,
                'content' => '',
                'section_id' => 1,
                'page_image' => 'admin@apprunn.com',
                'published_at' => $fecha,
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
        ];

        DB::table('articles')->insert($articlesRecords);
        */
        factory(Article::class, 10)->create();

    }
}
