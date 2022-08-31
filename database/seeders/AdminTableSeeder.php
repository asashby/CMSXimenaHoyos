<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id' => 1,
                'name' => 'Admin',
                'type' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Admin 123'),
                'image' => '',
                'activated' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Marcelo',
                'type' => 'admin',
                'email' => 'marcelo@gmail.com',
                'password' => bcrypt('Admin 123'),
                'image' => '',
                'activated' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Coral',
                'type' => 'admin',
                'email' => 'coral@gmail.com',
                'password' => bcrypt('Admin 123'),
                'image' => '',
                'activated' => 1,
            ],
        ];

        DB::table('admins')->insert($adminRecords);
    }
}
