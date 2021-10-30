<?php

use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->delete();
        $sliderRecords = [
            [
                'id' => 1,
                'title' => 'imagen 1',
                'slug' => 'imagen-1',
                'order' => 1
            ],
            [
                'id' => 2,
                'title' => 'imagen 2',
                'slug' => 'imagen-2',
                'order' => 2
            ],
            [
                'id' => 3,
                'title' => 'imagen 3',
                'slug' => 'imagen-3',
                'order' => 3,
            ],
            [
                'id' => 4,
                'title' => 'imagen 4',
                'slug' => 'imagen-4',
                'order' => 4
            ],
        ];

        DB::table('sliders')->insert($sliderRecords);
    }
}
