<?php

use App\Models\Event;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id');
            $table->foreignIdFor(Event::class)->nullable();
            $table->string('type'); // Announcement, Event
            $table->string('visibility');
            $table->text('content');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->foreignIdFor(User::class, 'verifier_id')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes here
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
