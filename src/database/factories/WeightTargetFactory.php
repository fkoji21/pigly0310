<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
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
            'target_weight' => $this->faker->randomFloat(1, 40, 100), // 40kg～100kgのランダム値
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
