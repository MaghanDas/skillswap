<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'difficulty',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('experience_level','is_teaching')
            ->withTimestamps();
    }

    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }
}