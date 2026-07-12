<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'rating',
        'comment'
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