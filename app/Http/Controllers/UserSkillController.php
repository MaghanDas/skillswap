<?php

namespace App\Http\Controllers;

use App\Models\UserSkill;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $userSkills = UserSkill::with(['user', 'skill'])->latest()->get();
        } else {
            $userSkills = UserSkill::with(['user', 'skill'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('user_skills.index', compact('userSkills'));
    }

    public function mySkills()
    {
        $userSkills = auth()->user()->userSkills()->with('skill')->get();
        $allSkills = Skill::with('category')->get();

        return view('user_skills.my-skills', compact('userSkills', 'allSkills'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect('/my-skills');
        }

        $users = User::all();
        $skills = Skill::all();

        return view('user_skills.create', compact('users', 'skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'skills' => 'required|array',
            'skills.*' => 'required|exists:skills,id',
            'experience_level' => 'nullable|in:beginner,intermediate,advanced',
            'is_teaching' => 'boolean'
        ]);

        $targetUserId = auth()->user()->isAdmin() && $request->filled('user_id')
            ? (int) $request->user_id
            : auth()->id();

        $experienceLevel = $request->input('experience_level', 'beginner');

        foreach ($request->skills as $skillId) {
            $existing = UserSkill::where('user_id', $targetUserId)
                                ->where('skill_id', $skillId)
                                ->first();

            if (!$existing) {
                UserSkill::create([
                    'user_id' => $targetUserId,
                    'skill_id' => $skillId,
                    'experience_level' => $experienceLevel,
                    'is_teaching' => $request->boolean('is_teaching', false)
                ]);
            }
        }

        return redirect()->back()->with('success', 'Skills added successfully!');
    }

    public function edit(UserSkill $userSkill)
    {
        if (!auth()->user()->isAdmin() && $userSkill->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $users = User::all();
        $skills = Skill::all();

        return view('user_skills.edit', compact('userSkill', 'users', 'skills'));
    }

    public function update(Request $request, UserSkill $userSkill)
    {
        if (!auth()->user()->isAdmin() && $userSkill->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'experience_level' => 'sometimes|in:beginner,intermediate,advanced',
            'is_teaching' => 'required|boolean'
        ]);

        $payload = [
            'is_teaching' => $request->is_teaching
        ];

        if ($request->filled('experience_level')) {
            $payload['experience_level'] = $request->experience_level;
        }

        $userSkill->update($payload);

        return redirect()->back()->with('success', 'Skill updated successfully!');
    }

    public function destroy(UserSkill $userSkill)
    {
        if (!auth()->user()->isAdmin() && $userSkill->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $userSkill->delete();

        return redirect('/user-skills');
    }
}