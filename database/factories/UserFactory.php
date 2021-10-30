<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Question;
use App\Scopes\ActivatedScope;
use App\Unit;
use App\User;
use App\Section;
use App\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(Article::class, function (Faker $faker) {
    $section_id = Section::pluck('id')->random();
    $title = $faker->sentence(mt_rand(3, 10));
    $sub_title = $faker->sentence(mt_rand(3, 10));
    $slug = Str::slug($title);
    return [
        'section_id' => $section_id,
        'admin_id' => 1,
        'slug' => $slug,
        'route' => $slug,
        'title' => $title,
        'subtitle' => $sub_title,
        'resume' => $faker->paragraph,
        'content' => $faker->paragraph,
        'page_image' => 'https://placeimg.com/100/100/any?' . rand(1, 100),
        'published_at' => now(),
    ];
});
$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'is_activated' => true,
        'url_image' => $faker->url,
        'file_url' => null
    ];
});


$factory->define(App\Unit::class, function (Faker $faker) {
    $courses_id = Course::withoutGlobalScope(ActivatedScope::class)->pluck('id')->random();
    $title = $faker->sentence(mt_rand(3, 10));
    return [
        'course_id' => $courses_id,
        'title' => $title,
        'content' => $faker->paragraph,
        'order' => $faker->unique()->randomDigit,
        'is_activated' => true

    ];
});

$factory->define(Question::class, function (Faker $faker) {
    $units_id = Unit::withoutGlobalScope(ActivatedScope::class)->pluck('id')->random();
    $title = $faker->sentence(mt_rand(3, 10));
    return [
        'unit_id' => $units_id,
        'title' => $title,
        'content' => $faker->paragraph,
        'is_activated' => $faker->numberBetween(0, 1)

    ];
});
