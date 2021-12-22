<?php

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
                'course_id' => json_encode([17]),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 2,
                'title' => 'plan Basico: 2 Meses',
                'price' => 139.0,
                'course_id' => json_encode([17]),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 3,
                'title' => 'plan Intermedio: 1 Mes',
                'price' => 79.0,
                'course_id' => json_encode([18]),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 4,
                'title' => 'plan Intermedio: 2 Meses',
                'price' => 139.0,
                'course_id' => json_encode([18]),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 5,
                'title' => 'plan Avanzado: 1 Mes',
                'price' => 79.0,
                'course_id' => json_encode([19]),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 6,
                'title' => 'plan Avanzado: 2 Meses',
                'price' => 139.0,
                'course_id' => json_encode([19]),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 7,
                'title' => 'plan Premium: 6 Meses',
                'price' => 399.0,
                'course_id' => json_encode([17, 18, 19]),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ]
        ];
        DB::table('plans')->insert($planRecord);
    }
}
