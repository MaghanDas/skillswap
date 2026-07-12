<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionBooking extends Model
{
    protected $fillable = [
        'session_id',
        'user_id',
        'status',
    ];

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}