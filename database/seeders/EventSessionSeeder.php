<?php

namespace Database\Seeders;

use App\Models\EventSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        EventSession::factory()->create([
            'event_id' => 1,
            'event_day' => 'Day 1',
            'name' => 'Morning in',
            'time_start' => '07:00am',
            'time_end' => '08:00am',
            'is_accepting_attendance' => true,
        ]);

    }
}
