<?php

namespace Database\Factories;

use App\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $units_id = Unit::withoutGlobalScope(ActivatedScope::class)->pluck('id')->random();
        $title = $this->faker->sentence(mt_rand(3, 10));
        return [
            'unit_id' => $units_id,
            'title' => $title,
            'content' => $this->faker->paragraph,
            'is_activated' => $this->faker->numberBetween(0, 1)

        ];
    }
}
