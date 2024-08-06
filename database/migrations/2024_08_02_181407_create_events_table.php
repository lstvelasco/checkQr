<?php

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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id');
            $table->string('name');
            $table->string('location')->nullable();
            $table->dateTime('event_start')->nullable();
            $table->dateTime('event_end')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_verified')->default(true);
            $table->string('status')->nullable(); // Upcoming, Completed, Ongoing
            $table->boolean('is_archived')->default(false);
            $table->boolean('can_override_status')->default(false); // If true, the status can be forced to be any of the three status and will not change automatically base on the server timer
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes here
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
