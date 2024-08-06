<?php

namespace Database\Factories;

use App\Models\Avatar;
use App\Models\BankAccount;
use App\Models\Identification;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'last_name' => fake()->lastName(),
            'birthday' => fake()->date(),
            'identity_verified' => fake()->randomElement([true, false]),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'contact_num' => null,
            'address' => fake()->address(),
            'account_type' => fake()->randomElement(['Model', 'Photographer', 'Event Organizer', 'Project Manager']),
            'status' => fake()->randomElement(['active', 'disabled', 'banned', 'deleted']),
            // 'avatar_id' => Avatar::factory(),
            // 'identification_id' => Identification::factory(),
            // 'bank_account_id' => BankAccount::factory(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            // 'password' => static::$password ??= Hash::make('password'),
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
