<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();
        $sectionsRecords = [
            [
                'id' => 1,
                'name' => 'PARA RECONOCER',
                'description' => 'Articulos para seccion Para Reconocer',
                'slug' => 'para-reconocer',
                'route' => 'para-reconocer',
                'activated' => 1,
                'order' => 1,
            ],
            [
                'id' => 2,
                'name' => 'PARA COMPARTIR',
                'description' => 'Articulos para seccion Para Compartir',
                'slug' => 'para-compartir',
                'route' => 'para-compartir',
                'activated' => 1,
                'order' => 2,
            ],
            [
                'id' => 3,
                'name' => 'PARA CONSTRUIR',
                'description' => 'Articulos para seccion Para Construir',
                'slug' => 'para-constuir',
                'route' => 'para-constuir',
                'activated' => 1,
                'order' => 3,
            ],
            [
                'id' => 4,
                'name' => 'PARA AVANZAR',
                'description' => 'Articulos para seccion Para Avanzar',
                'slug' => 'para-avanzar',
                'route' => 'para-avanzar',
                'activated' => 1,
                'order' => 4,
            ],
        ];

        DB::table('sections')->insert($sectionsRecords);
        // Section::insert($sectionsRecords);
    }
}
