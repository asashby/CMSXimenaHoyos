<?php

use App\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $this->call(AdminTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(UsersTableSeeders::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
    }
}
