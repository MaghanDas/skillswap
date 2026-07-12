<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function skills()
{
    return $this->belongsToMany(Skill::class, 'user_skills')
        ->withPivot('experience_level','is_teaching')
        ->withTimestamps();
}

    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }

    public function teachingSessions()
    {
        return $this->hasMany(Session::class, 'teacher_id');
    }

    public function learningSessions()
    {
        return $this->hasMany(Session::class, 'student_id');
    }

    public function sessionBookings()
    {
        return $this->hasMany(SessionBooking::class);
    }

    public function bookedSessions()
    {
        return $this->belongsToMany(Session::class, 'session_bookings', 'user_id', 'session_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function sessionsAsTeacher()
    {
        return $this->teachingSessions();
    }

    public function sessionsAsStudent()
    {
        return $this->learningSessions();
    }

// Check if user is a teacher
public function isTeacher() { return $this->role === 'teacher'; }

// Check if user is a student
public function isStudent() { return $this->role === 'student'; }

// Check if admin
public function isAdmin() { return $this->role === 'admin'; }

}
