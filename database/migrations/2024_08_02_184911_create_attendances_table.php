<?php

use App\Models\Event;
use App\Models\EventSession;
use App\Models\User;
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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Event::class);
            $table->foreignIdFor(EventSession::class);
            $table->foreignIdFor(User::class, 'attendee_id');
            $table->boolean('is_present');
            $table->foreignIdFor(User::class, 'validator_id')->default(null)->nullable(); // If null, it means the attendance was done by the attendee using the system
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
