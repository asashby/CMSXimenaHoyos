<?php

use Illuminate\Database\Seeder;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = new DateTime('now', new DateTimeZone('America/Lima'));
        DB::table('users')->delete();
        $userRecord = [
            [
                'id' => 1,
                'name' => 'Airom',
                'sur_name' => 'Vergara',
                'email' => 'airom@gmail.com',
                'password' => '$2y$10$1YE0fji.pxz.g4S./hIRdOHUvVN7RYvD.vaAHWaC4qzFE3JbK8CUu',
                'is_activated' => 1,
                'external_enterprise' => 0,
                'enterprise' => 'Enel',
                'addittional_info' => json_encode(['gender' => 'male', 'worker_type' => 'Independiente', 'nameCity' => 'Lima']),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
        ];

        DB::table('users')->insert($userRecord);
    }
}
