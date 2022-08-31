<?php

namespace Database\Seeders;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = new DateTime('now', new DateTimeZone('America/Lima'));
        DB::table('areas')->delete();
        $areasRecord = [
            [
                'id' => 1,
                'name' => 'Finanzas',
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 2,
                'name' => 'Redes',
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 3,
                'name' => 'RRHH',
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ], [
                'id' => 4,
                'name' => 'Contabilidad',
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ]
        ];

        DB::table('areas')->insert($areasRecord);
    }
}
