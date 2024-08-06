<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rater_id' => User::factory(),
            'ratee_id' => User::factory(),
            'rating' => fake()->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'comment' => fake()->sentence()
        ];
    }
}
