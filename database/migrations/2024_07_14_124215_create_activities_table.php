<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'author_id');
            $table->string('action');
            $table->foreignIdFor(User::class, 'receiver_id')->nullable();
            $table->string('link')->nullable();
            $table->boolean('notify')->default(false);
            $table->boolean('isRead')->default(false);
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes here
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
