<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payer_id' => User::factory(),
            'payee_id' => User::factory(),
            'event_id' => Event::factory(),
            'amount' => '₱6000',
            'status' => fake()->randomElement(['pending', 'complete'])
        ];
    }
}
