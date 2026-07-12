<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillSession extends Model
{
    protected $fillable = [
        'teacher_id',
        'student_id',
        'skill_id',
        'title',
        'description',
        'session_date',
        'session_time',
        'duration',
        'location',
        'status'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class,'student_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'session_id');
    }
}