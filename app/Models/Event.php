<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    public function author(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function sessions()
    {
        return $this->hasMany(EventSession::class);
    }
    
    public function attendanceCodes()
    {
        return $this->hasMany(AttendanceCode::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
