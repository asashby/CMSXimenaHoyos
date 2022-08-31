<?php

namespace Database\Factories;

use App\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $courses_id = Course::withoutGlobalScope(ActivatedScope::class)->pluck('id')->random();
        $title = $this->faker->sentence(mt_rand(3, 10));
        return [
            'course_id' => $courses_id,
            'title' => $title,
            'content' => $this->faker->paragraph,
            'order' => $this->faker->unique()->randomDigit,
            'is_activated' => true

        ];
    }
}
