<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Event::class);
            $table->string('event_day'); // Day 1, Day 2, Day 3, etc
            $table->string('name'); // Morning in, Morning out, Afternoon in, Afternoon out
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->boolean('is_accepting_attendance')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_sessions');
    }
};
