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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id');
            $table->string('name');
            $table->string('location')->nullable();
            $table->dateTime('announcement_start')->nullable();
            $table->dateTime('announcement_end')->nullable();
            $table->boolean('isVerified')->default(false);
            $table->foreignIdFor(User::class, 'verifier_id')->nullable();
            $table->string('status')->nullable(); // Upcoming, Completed, Ongoing
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes here
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
