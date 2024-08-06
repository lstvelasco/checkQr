<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    // protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function avatars(): HasMany
    {
        return $this->hasMany(Avatar::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'user1_id')
                    ->orWhere('user2_id', $this->id);
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function conversationsAsUser1(): HasMany
    {
        return $this->hasMany(Conversation::class, 'user1_id');
    }

    public function conversationsAsUser2(): HasMany
    {
        return $this->hasMany(Conversation::class, 'user2_id');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'author_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(User::class, 'author_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class, 'author_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'author_id');
    }

    public function attendanceCodes()
    {
        return $this->hasMany(AttendanceCode::class, 'attendee_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'attendee_id');
    }

    public function validatedAttendances()
    {
        return $this->hasMany(Attendance::class, 'validator_id');
    }

}
