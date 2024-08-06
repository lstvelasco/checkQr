<?php

namespace Database\Seeders;

use App\Models\AttendanceCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttendanceCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttendanceCode::factory()->create([
            'id' => Str::uuid(),
            'attendee_id' => 1,
            'event_id' => 1,
            'event_session_id' => 1,
            'is_active' => true, 
        ]);
        AttendanceCode::factory()->create([
            'id' => Str::uuid(),
            'attendee_id' => 2,
            'event_id' => 1,
            'event_session_id' => 1,
            'is_active' => true, 
        ]);
    }
}
