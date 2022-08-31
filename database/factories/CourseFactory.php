<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'is_activated' => true,
            'url_image' => $this->faker->url,
            'file_url' => null,
            'days' => 10
        ];
    }
}
