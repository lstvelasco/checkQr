<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'first_name' => 'Luisito',
            'middle_name' => 'Bantigue',
            'last_name' => 'Velasco Jr.',
            'student_id' => '15B1511',
            'section' => 'E',
            'major' => 'Software Development',
            'year' => '4th',
            'birthday' => fake()->dateTimeBetween('-20 years', 'now'),
            'identity_verified' => true,
            'gender' => 'Male',
            'address' => 'Purok Rosal, Mahinhin, Boac',
            'account_type' => 'Student',
            'role' => 'Attendance Officer',
            'status' => 'active',
            'email' => 'lstvelasco@gmail.com',
            'password' => bcrypt('test123'),
        ]);

        User::factory()->create([
            'first_name' => 'Marlon',
            'middle_name' => 'Bantigue',
            'last_name' => 'Velasco',
            'student_id' => '18B1811',
            'section' => 'E',
            'major' => 'Networking and Data Security',
            'year' => '4th',
            'birthday' => fake()->dateTimeBetween('-20 years', 'now'),
            'identity_verified' => true,
            'gender' => 'Male',
            'address' => 'Purok Rosal, Mahinhin, Boac',
            'account_type' => 'Student',
            'role' => 'Attendee',
            'status' => 'active',
            'email' => 'marlon@gmail.com',
            'password' => bcrypt('test123'),
        ]);

        User::factory()->create([
            'first_name' => 'Nellen',
            'middle_name' => 'Fabayos',
            'last_name' => 'Sagundo',
            'student_id' => '15C1511',
            'section' => 'E',
            'major' => 'Networking and Data Security',
            'year' => '4th',
            'birthday' => fake()->dateTimeBetween('-20 years', 'now'),
            'identity_verified' => true,
            'gender' => 'Female',
            'address' => 'Purok Rosal, Mahinhin, Boac',
            'account_type' => 'Student',
            'role' => 'Attendee',
            'status' => 'active',
            'email' => 'sagundonellen89@gmail.com',
            'password' => bcrypt('test123'),
        ]);

    }
}
