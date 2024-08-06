<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->string('gender'); // male, female, others
            $table->string('email')->unique();
            $table->string('section');
            $table->string('major');
            $table->string('year'); // 1st, 2nd, 3rd, 4th
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('identity_verified')->default(false);
            $table->string('contact_num')->nullable();
            $table->string('address')->nullable();
            $table->string('account_type')->default('Student'); // dean, staff, faculty, student
            $table->string('role')->default('Attendee'); // Attendance Officer , attendee
            $table->string('status')->default('Active'); // active, disabled, banned, deleted
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
