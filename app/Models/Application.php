<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
