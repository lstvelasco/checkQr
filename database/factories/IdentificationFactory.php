<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Identification>
 */
class IdentificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'image_url' => fake()->imageUrl(),
            'id_type' => fake()->randomElement(['School id', 'National id', 'Philhealth id', 'Drivers License']),
            'status' => fake()->randomElement(['Pending', 'Verified', 'Rejected', 'Not yet applied']),
        ];
    }
}
