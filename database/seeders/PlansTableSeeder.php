<?php

namespace Database\Seeders;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = new DateTime('now', new DateTimeZone('America/Lima'));
        DB::table('plans')->delete();
        $planRecord = [
            [
                'id' => 1,
                'title' => 'plan Basico: 1 Mes',
                'price' => 79.0,
                'slug' => json_encode(['basico-en-casa']),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 2,
                'title' => 'plan Basico: 2 Meses',
                'price' => 139.0,
                'slug' => json_encode(['basico-en-casa']),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 3,
                'title' => 'plan Intermedio: 1 Mes',
                'price' => 79.0,
                'slug' => json_encode(['intermedio-en-casa']),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 4,
                'title' => 'plan Intermedio: 2 Meses',
                'price' => 139.0,
                'slug' => json_encode(['intermedio-en-casa']),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 5,
                'title' => 'plan Avanzado: 1 Mes',
                'price' => 79.0,
                'slug' => json_encode(['avanzado-en-gym']),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 6,
                'title' => 'plan Avanzado: 2 Meses',
                'price' => 139.0,
                'slug' => json_encode(['avanzado-en-gym']),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 7,
                'title' => 'plan Premium: 6 Meses',
                'price' => 399.0,
                'slug' => json_encode(['basico-en-casa', 'intermedio-en-casa', 'avanzado-en-gym']),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ]
        ];
        DB::table('plans')->insert($planRecord);
    }
}
