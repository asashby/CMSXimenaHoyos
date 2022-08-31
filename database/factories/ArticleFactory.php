<?php

namespace Database\Factories;

use App\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $section_id = Section::pluck('id')->random();
        $title = $this->faker->sentence(mt_rand(3, 10));
        $sub_title = $this->faker->sentence(mt_rand(3, 10));
        $slug = Str::slug($title);
        return [
            'section_id' => $section_id,
            'admin_id' => 1,
            'slug' => $slug,
            'route' => $slug,
            'title' => $title,
            'subtitle' => $sub_title,
            'description' => $this->faker->paragraph,
            'content' => $this->faker->paragraph,
            'page_image' => 'https://placeimg.com/100/100/any?' . rand(1, 100),
            'published_at' => now(),
        ];
    }
}
