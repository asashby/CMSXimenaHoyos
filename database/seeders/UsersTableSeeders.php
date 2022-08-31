<?php

namespace Database\Seeders;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'name' => 'Administrator',
                'sur_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Admin 123'),
                'is_activated' => 1,
                'external_enterprise' => 0,
                'enterprise' => 'Enel',
                'addittional_info' => json_encode([
                    'gender' => 'male',
                    'worker_type' => 'Independiente',
                    'nameCity' => 'Lima'
                ]),
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
        ];

        DB::table('users')->insert($userRecord);
    }
}
