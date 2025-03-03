<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1, // 1人目のユーザーに紐付け
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 40, 100),
            'calories' => $this->faker->numberBetween(1000, 3000),
            'exercise_time' => $this->faker->time(),
            'exercise_content' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
