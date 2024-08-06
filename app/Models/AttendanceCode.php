<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $keyType = 'string';

    public $incrementing = false;
    
    public function attendee()
    {
        return $this->belongsTo(User::class, 'attendee_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function eventSession()
    {
        return $this->belongsTo(EventSession::class);
    }
}
