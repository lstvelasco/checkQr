<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        // $this->call(EventSeeder::class);
        // $this->call(EventSessionSeeder::class);
        // $this->call(AttendanceCodeSeeder::class);
        // $this->call(AvatarSeeder::class);
        // $this->call(IdentificationSeeder::class);
        // $this->call(BankAccountSeeder::class);


    }
}
