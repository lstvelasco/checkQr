<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory()->create([
            'author_id' => '1',
            'name' => 'Intrams',
            'location' => 'MSC Gymnasium',
            'event_start' => '2024-08-02',
            'event_end' => '2024-08-05',
            'description' => 'Welcome',
        ]);

    }
}
